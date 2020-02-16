<?php

if ( ! function_exists('spikkl')) {

    /**
     * Helper function to access the Spikkl api instance.
     *
     * @return mixed
     */
    function spikkl()
    {
        return resolve('spikkl.api');
    }
}