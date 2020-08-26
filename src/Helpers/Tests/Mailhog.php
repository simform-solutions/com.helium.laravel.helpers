<?php

namespace Helium\LaravelHelpers\Helpers\Tests;

use Http\Client\Curl\Client;
use Nyholm\Psr7\Factory\HttplugFactory;
use rpkamp\Mailhog\MailhogClient;

class Mailhog
{
    protected static $client;

    public static function client(): MailhogClient
    {
        if (!self::$client) {
            self::$client =  new MailhogClient(
                new Client(),
                new HttplugFactory(),
                self::$baseUri ?? 'http://mailhog:8025/'
            );
        }

        return self::$client;
    }
}