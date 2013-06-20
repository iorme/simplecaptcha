<?php
namespace Iorme\SimpleCaptcha\Facades;

use Illuminate\Support\Facades\Facade;

class SimpleCaptcha extends Facade {
	protected static function getFacadeAccessor() {
		return 'simplecaptcha';
	}
}
?>