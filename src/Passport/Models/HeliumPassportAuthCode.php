<?php

namespace Helium\LaravelHelpers\Passport\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Laravel\Passport\AuthCode;

class HeliumPassportAuthCode extends AuthCode
{
    use GeneratesPrimaryKey;

    public $primaryKeyPrefix = 'PP-ACD';
}