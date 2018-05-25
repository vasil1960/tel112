<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Session;

class IagSessionProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {

		view()->composer('*', function ($view) {
			$view->with([
				'sid' => Session::get('sid'),
				'username' => Session::get('username'),
				'userId' => Session::get('userId'),
				'SelYear' => Session::get('SelYear'),
				'AccessPodelenia' => Session::get('AccessPodelenia'),
				'Access112' => Session::get('Access112'),
				'Access' => Session::get('Access'),
				'ActiveSession' => Session::get('ActiveSession'),
				'FullName' => Session::get('FullName'),
				'Podelenie' => Session::get('Podelenie'),
			]);
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
