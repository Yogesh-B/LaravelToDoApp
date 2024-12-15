<?php

namespace Tests;

// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    // use DatabaseMigrations;
    use RefreshDatabase;
    // use DatabaseTransactions;

    //Thanks to ChatGPT
    // protected static $migrated = false;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     // Run migrations only once
    //     if (!static::$migrated) {
    //         Artisan::call('migrate:fresh');
    //         static::$migrated = true;
    //     }
    // }

    
}
