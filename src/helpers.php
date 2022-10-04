<?php

use Spikkl\Laravel\ApiClientAdapter;

if ( ! function_exists('spikkl')) {

    /**
     * Helper function to access the Spikkl api instance.
     *
     * @return ApiClientAdapter
     */
    function spikkl(): ApiClientAdapter
    {
        return resolve('spikkl.api');
    }
}