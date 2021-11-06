# LeakCheck Laravel Integration

![LeakCheck <3 Laravel](https://i.imgur.com/B8DyH1y.png)
<p align="center">
<img alt="Discord" src="https://img.shields.io/discord/626798391162175528">
<img alt="Packagist Downloads" src="https://img.shields.io/packagist/dm/leakcheck/leakcheck-laravel">
<img alt="Uptime Robot ratio (30 days)" src="https://img.shields.io/uptimerobot/ratio/m787582856-3411c8623fccb7e99d3dfc1f">
<img alt="GitHub" src="https://img.shields.io/github/license/leakcheck/leakcheck-laravel">
</p>

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

    'leakcheck' => 'You can not use this password as it was compromised'

*This package licensed under MIT license. Laravel is a Trademark of Taylor Otwell.* 
