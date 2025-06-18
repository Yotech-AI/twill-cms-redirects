<?php

namespace TwillRedirects\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectMiddleware
{
    /**
     * Check the requested URL against the configured redirect rules and
     * perform a redirect when a match is found. If no rule matches the
     * request, control is passed to the next middleware/route handler.
     */
    public function handle(Request $request, Closure $next)
    {
        $redirects = Cache::rememberForever('twill_redirects', function () {
            return optional(Redirect::first())->redirects ?? [];
        });

        $path = '/' . ltrim($request->path(), '/');

        foreach ($redirects as $rule) {
            $from = $rule['from'] ?? null;
            $to = $rule['to'] ?? null;
            $status = (int) ($rule['statuscode'] ?? 302);

            if ($from && $this->matches($path, $from)) {
                Log::info('Redirect match', ['from' => $path, 'to' => $to, 'status' => $status]);
                return redirect($to, $status);
            }
        }

        return $next($request);
    }

    private function matches(string $path, string $pattern): bool
    {
        $pattern = '/' . ltrim($pattern, '/');

        if (str_ends_with($pattern, '*')) {
            return str_starts_with($path, rtrim($pattern, '*'));
        }

        return rtrim($path, '/') === rtrim($pattern, '/');
    }
}
