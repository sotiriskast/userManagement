<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase; // Ensures database is refreshed before each test

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure the database is migrated before seeding
        $this->artisan('migrate');

        // Seed the database
        $this->artisan('db:seed');
    }
}
