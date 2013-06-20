<?php
namespace Iorme\SimpleCaptcha;

use Illuminate\Support\ServiceProvider;

class SimpleCaptchaServiceProvider extends ServiceProvider {
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot() {
		$this->package('iorme/simplecaptcha');
		$app = $this->app;

		$this->app->finish(function() use $app
		{

		});
	}

	public function register() {
		$this->app['simplecaptcha'] = $this->app->share(function($app)
		{
			return new SimpleCaptcha();
		});
	}

	public function provides() {
		return array('simplecaptcha');
	}
}
?>