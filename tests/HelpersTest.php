<?php

namespace Tests;

use Spikkl\Laravel\ApiClientAdapter;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function helper_provides_spikkl_instance(): void
    {
        $this->assertTrue(function_exists('spikkl'));

        $this->assertInstanceOf(ApiClientAdapter::class, spikkl());
    }
}