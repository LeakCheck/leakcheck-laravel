<?php
/**
 * Copyright (c) 2018-2021 LeakCheck Security Services LTD
 * Licensed under MIT license
 * Github: https://github.com/LeakCheck/leakcheck-laravel
 * Created with <3
 */

namespace LeakCheck;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class LeakCheckServiceProvider
 * @package LeakCheck
 */
class LeakCheckServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     *
     */
    public function boot()
    {

        $this->addValidationRule();
        $this->publishes([
            __DIR__ . '/../config/leakcheck.php' => config_path('leakcheck.php'),
        ], 'config');

    }

    /**
     * Extends Validator to include a rule.
     */
    public function addValidationRule()
    {
        Validator::extendImplicit('leakcheck', function ($attribute, $value) {
            return app('leakcheck')->validate($value);
		}, trans('validation.leakcheck'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/leakcheck.php', 'leakcheck'
        );

        $this->app->singleton('leakcheck', function ($app) {
            return new LeakCheck(
                config('leakcheck.api_key'),
                config('leakcheck.strict'),
                config('leakcheck.timeout')
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['leakcheck'];
    }

}