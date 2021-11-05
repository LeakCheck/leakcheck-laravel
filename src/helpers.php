<?php
/**
 * Copyright (c) 2018-2021 LeakCheck Security Services LTD
 * Licensed under MIT license
 * Github: https://github.com/LeakCheck/leakcheck-laravel
 * Created with <3
 */

if(!function_exists('sha256'))
{
    /**
     * Helper to use with Str::pipe
     * 
     * @param string $value
     */
    function sha256($value)
    {
        return hash('sha256', $value);
    }
}