<?php

namespace Helium\LaravelHelpers\Passport\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Laravel\Passport\PersonalAccessClient;

class HeliumPassportPersonalAccessClient extends PersonalAccessClient
{
    use GeneratesPrimaryKey;

    public $primaryKeyPrefix = 'PP-PAC';
}