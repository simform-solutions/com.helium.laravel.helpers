<?php

namespace Helium\LaravelHelpers\Passport\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Laravel\Passport\Client;

class HeliumPassportClient extends Client
{
    use GeneratesPrimaryKey;

    public $primaryKeyPrefix = 'PP-CLI';
}