<?php

namespace TwillRedirects;

use A17\Twill\TwillPackageServiceProvider;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;

class TwillRedirectsServiceProvider extends TwillPackageServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        $migrationPath = __DIR__ . '/Twill/Capsules/Redirects/Database/migrations';
        $this->loadMigrationsFrom($migrationPath);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $migrationPath => database_path('migrations'),
            ], 'twill-cms-redirects-migrations');
        }
    }
}
