<?php
/**
 * Copyright (c) 2018-2021 LeakCheck Security Services LTD
 * Licensed under MIT license
 * Github: https://github.com/LeakCheck/leakcheck-laravel
 * Created with <3
 */

return [

    /**
     * Your API key with Enterprise license
     * Get it @ https://leakcheck.io/api_s
     */

    'api_key' => env('LEAKCHECK_API_KEY', ''),

    /**
     * Strict mode
     * Allow your users to register in case Exception/Timeout occured or your key does not have a license.
     * 
     * Defaults to false (= allow)
     */

    'strict' => false,

    /** 
     * Set timeout
     * Usually it takes ~300-400 ms to verify a password.
     * 
     * Defaults to 3s
     */
    'timeout' => 3

];