<?php

namespace Helium\LaravelHelpers\Providers;

use Helium\IdpClient\Middleware\IdpAuthenticate;
use Helium\LaravelHelpers\Middleware\CastCamelToSnake;
use Illuminate\Support\ServiceProvider;

class HeliumHelpersServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadTranslationsFrom(__DIR__ . '/../lang/', 'heliumHelpers');

		$this->publishes([
			__DIR__ . '/../lang/' => resource_path('lang/vendor/heliumHelpers'),
			__DIR__ . '/../config/batch.php' => config_path('batch.php')
		]);

		if ($this->app->runningInConsole())
		{
			$this->commands([
			]);
		}
	}

	public function register()
    {
        app('router')->aliasMiddleware('camelCase', CastCamelToSnake::class);
    }
}