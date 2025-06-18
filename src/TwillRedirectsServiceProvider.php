<?php

namespace TwillRedirects;

use A17\Twill\TwillPackageServiceProvider;
use Illuminate\Support\Facades\Route;
use TwillRedirects\Http\Middleware\RedirectMiddleware;

class TwillRedirectsServiceProvider extends TwillPackageServiceProvider
{
    public function boot(): void
    {
        $this->registerCapsules('Capsules');
        $this->loadMigrationsFrom(__DIR__ . '/Twill/Capsules/Redirects/database/migrations');

        Route::aliasMiddleware('twill.redirects', RedirectMiddleware::class);
    }
}
