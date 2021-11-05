<?php
/**
 * Copyright (c) 2018-2021 LeakCheck Security Services LTD
 * Licensed under MIT license
 * Github: https://github.com/LeakCheck/leakcheck-laravel
 * Created with <3
 */

namespace LeakCheck;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class LeakCheck
{
    const API_URL = 'https://leakcheck.io/api/hasbreached';

    /**
     * LeakCheck API key
     * 
     * @var string
     */
    protected $key;

    /** 
     * Strict mode
     * If set to false, validation will always pass independently of any exceptions occured.
     * If set to true, exception will be thrown (if any).
     * 
     * @var bool
     */
    protected $strict;

    /** 
     * Timeout
     * 
     * @var int
     */
    protected $timeout;

    /**
     * @param string $key
     * @param bool $strict
     * @param int $timeout
     */
    public function __construct($key, $strict, $timeout)
    {
        $this->key = $key;
        $this->strict = $strict;
        $this->timeout = $timeout;
    }

    /**
     * Basically, here are all main functionality of this package.
     * 
     * As we value users` privacy we hash all passwords with SHA256, truncate to 24 characters and only then
     * send to the server.
     * 
     * @param string $password
     * 
     * @return bool
     * @throws \Exception
     */
    public function validate($password)
    {
        $password = Str::of($password)->lower()->pipe('sha256')->substr(0, 24);

        try {
            $response = Http::timeout($this->timeout)->get(static::API_URL, [
                'key' => $this->key,
                'check' => (string) $password,
            ])->json();

            if($response['success'] === false) {
                throw new \Exception($response['error']);
            }

            return ! $response['breached'];
        } catch(\Throwable $e) {
            report($e);

            if($this->strict) {
                throw $e;
            }

            return true;
        }
    }
}