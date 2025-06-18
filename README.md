# Twill CMS Redirects

This package provides a simple redirect management capsule for [Twill](https://twillcms.com). It registers a singleton module where you can configure redirect rules that are applied by middleware on every request.

## Installation

```bash
composer require yotech-ai/twill-cms-redirects
```

## Migration

Publish and run the package migration:

```bash
php artisan vendor:publish --tag="twill-cms-redirects-migrations"
php artisan migrate
```

## Usage

The capsule creates a singleton module called `redirects`. Administrators can define redirect rules through the Twill UI. Each rule contains a `from` URL, a `to` URL and the status code to use.

Requests are intercepted by `twill.redirects` middleware which performs the redirect if a rule matches.

## Activation

Add the service provider and middleware alias to your `config/twill.php` if not automatically discovered:

```php
'providers' => [
    // ...
    TwillRedirects\TwillRedirectsServiceProvider::class,
],
```

Laravel 11 no longer uses the `Http\Kernel` class for middleware
registration. Instead, middleware is configured in `bootstrap/app.php`.
Because redirect rules may apply to URLs that don't match any defined
route, the middleware should run before route resolution. Prepend it to
the global middleware stack within the `withMiddleware` closure:

```php
use TwillRedirects\Http\Middleware\RedirectMiddleware;
use Illuminate\Foundation\Configuration\Middleware;

->withMiddleware(function (Middleware $middleware) {
    $middleware->prepend(RedirectMiddleware::class);
})
```

### Navigation

Add a link to the admin navigation so editors can access the singleton:

```php
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;

TwillNavigation::addLink(
    NavigationLink::make()->forSingleton('redirect')
);
```

If you are using the [twill-navigation](https://github.com/area17/twill-navigation) package, register the capsule in `config/twill-navigation.php`.

## Seeder

A `RedirectSeeder` is included and will create the initial singleton record if none exists. Twill automatically runs this seeder when you visit the capsule for the first time.

## License

MIT
