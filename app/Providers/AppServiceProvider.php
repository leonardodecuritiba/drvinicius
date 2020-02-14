<?php

namespace App\Providers;

use App\Models\Entities\Entity;
use App\Observers\Entites\EntityObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton( FakerGenerator::class, function () {
			return FakerFactory::create( 'pt_BR' );
		} );
	}
}
