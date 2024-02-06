<?php

namespace Webudvikleren\CrudPermissions\Providers;

use Illuminate\Support\ServiceProvider;

class CrudPermissionsProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 * 
	 * @return void
	 */
	public function boot()
	{
		//$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		$this->loadTranslationsFrom(__DIR__ . '/../lang', 'crudpermissions');
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'crudpermissions');
		/*$this->mergeConfigFrom(
			__DIR__.'/../config/crudpermissions.php', 'crudpermissions'
		);*/
	}
}