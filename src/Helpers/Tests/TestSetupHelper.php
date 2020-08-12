<?php

namespace Helium\LaravelHelpers\Helpers\Tests;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Artisan;

class TestSetupHelper
{
    protected static $isSetUp = false;

    public static function migrateDatabaseOnce(): void
    {
        if (!self::$isSetUp) {
            $env = Dotenv::createMutable(__DIR__, '/../.env.testing');
            $env->load();

            println('Migrating database...');
            Artisan::call('migrate:fresh');
            println('Finished migrating.');

            self::$isSetUp = true;
        }
    }
}