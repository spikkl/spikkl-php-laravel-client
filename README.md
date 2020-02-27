<p align="center">
    <img src="https://spikkl.nl/images/hub/github/laravel.png" width="128" height="128" />
</p>
<h1 align="center">Spikkl for Laravel</h1>

Spikkl-php-laravel-client incorporates the [Spikkl API](https://www.spikkl.nl/documentation) into your [Laravel](https://www.laravel.com) or [Lumen](https://lumen.laravel.com) project.

[![Build Status](https://travis-ci.org/spikkl/spikkl-php-laravel-client.png)](https://travis-ci.org/spikkl/spikkl-php-laravel-client)

## Requirements ##

+ Get yourself a free [Spikkl account](https://www.spikkl.nl/signup). No sign up costs.
+ Follow [a few steps](https://www.spikkl.nl/account/billing) to enable a suitable subscription to talk to the API.
+ A valid API key which can be generated from your [Spikkl dashboard](https://www.spikkl.nl/credentials).
+ PHP >= 7.1.
+ [Laravel](https://www.laravel.com) (or [Lumen](https://lumen.laravel.com)) >= 5.5

## Installation ##
Add Spikkl-php-laravel-client to your composer file via the `composer require` command:

```bash
   $ composer require spikkl/spikkl-php-laravel-client:^1.0
``` 

Or add it to `composer.json` manually:

```json
"require": {
  "spikkl/spikkl-php-laravel-client": "^1.0"
}
```

Spikkl-php-laravel-client's service provider will be automatically registered using Laravel's auto-discovery feature.

Note: for Lumen you have to add the Spikkl facade and service provider manually to: `bootstrap/app.php`:

```php
$app->withFacades(true, [ 'Spikkl\Laravel\Facades\Spikkl' => 'Spikkl' ]);

$app->register(Spikkl\Laravel\ServiceProvider::class);
```

## Configuration ##
You will only need to  add the `SPIKKL_API_KEY` variable to your `.env` file.

```php
SPIKKL_API_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

## Example usage
Here you can see an example of just how simple this package is to use.

### Location lookup by supported country code, postal code, street number, and street number suffix.

```php
$results = Spikkl::api()->lookup('nld', '2611HB', '175', null);
```

### Location reverse lookup by supported country code, latitude, and longitude

```php
$results = Spikkl::api()->reverse('nld', 52.012133, 4.354901);
```

### Global helper method
For your convenience we have added the global `spikkl()` helper  function. It is an easy shortcut to the `Spikkl::api()` facade accessor.

```php
// Using facade accessor
$results = Spikkl::api()->lookup('nld', '2611HB', '175', null);

// Using global helper function
$results = spikkl()->lookup('nld', '2611HB', '175', null);
```

## License

[BSD (Berkeley Software Distribution) License](http://www.opensource.org/licenses/bsd-license.php). Copyright (c) 2020, Spikkl

## Support

Contact: [www.spikkl.nl](https://www.spikkl.nl) — info@spikkl.nl

* [Documentation for the Spikkl API](https://www.spikkl.nl/documentation/)