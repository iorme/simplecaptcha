Simple PHP captcha generator for Laravel 4 

# Installation

composer.json
```json
"require": {
		"iorme/simplecaptcha": "dev-master"
	},
```
install 
```bash
$ /path/to/composer.phar install
```

# Usage

Add the service provider, open `app/config/app.php` and add new item to the providers array :

'Iorme\SimpleCaptcha\SimpleCaptchaServiceProvider',

then add the alias to the aliases array:

'SimpleCaptcha'	  => 'Iorme\SimpleCaptcha\Facades\SimpleCaptcha',	

On the view file :

```php
<p>
    {{ HTML::image(URL::to('simplecaptcha'),'Captcha') }}
    {{ Form::label('captcha', '* Captcha:') }}
    {{ Form::text('captcha') }}
</p>
```

check the captcha string on the controllers :

```php
$check = SimpleCaptcha::check($input['captcha']);

if($check == true) {
	echo "captcha string is right";
} else {
	echo "captcha string is wrong";
}
```