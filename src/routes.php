<?php
Route::get('/simplecaptcha', ['as'=>'captcha','do'=>function()
{	
	$c = new Iorme\SimpleCaptcha\SimpleCaptcha();
    return $c->create();
}]);
?>