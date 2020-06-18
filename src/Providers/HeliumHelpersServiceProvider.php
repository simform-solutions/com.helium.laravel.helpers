<?php

namespace Helium\LaravelHelpers\Providers;

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
}