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
        $migrationPath = __DIR__ . '/Twill/Capsules/Redirects/database/migrations';
        $this->loadMigrationsFrom($migrationPath);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $migrationPath => database_path('migrations'),
            ], 'twill-cms-redirects-migrations');
        }

        Route::aliasMiddleware('twill.redirects', RedirectMiddleware::class);
    }
}
