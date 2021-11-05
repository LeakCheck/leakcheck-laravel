# LeakCheck Laravel Integration
![LeakCheck <3 Laravel](https://i.imgur.com/cUyDWGX.png)
Yet another secure way to check if your users` passwords became a part of a breach.
Before sending a password to the server we hash it with SHA256 and truncate to 24 characters. 

This package was tested with Laravel 8.64 & PHP 7.3, but should work with Laravel >=7.0 too.

## Installation

 1. Install with `composer require leakcheck/leakcheck-laravel`
 2. Publish a configuration file `php artisan vendor:publish --provider "LeakCheck\LeakCheckServiceProvider"`
 3. Set your LeakCheck API key in .env `LEAKCHECK_API_KEY=000011112222...`

And you're all set!
    
## Usage

    use Illuminate\Support\Facades\Validator;
    
    $validator = Validator::make($request->all(), [
		'password' => 'required|string|leakcheck'
    ]);

You can even use it with standard Laravel's password breach checker:

	use Illuminate\Support\Facades\Validator;
	use Illuminate\Validation\Rules\Password;
	
    $validator = Validator::make($request->all(), [
		'password' => ['required', 'string', Password::min(8)->uncompromised(), 'leakcheck']
    ]);

## Localization

\<lang>/validation.php

    'leakcheck' => 'You can not use this password as it became a part of a breach'

*This package licensed under MIT license. Laravel is a Trademark of Taylor Otwell.* 
