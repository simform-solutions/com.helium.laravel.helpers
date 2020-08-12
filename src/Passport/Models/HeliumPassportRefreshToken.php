<?php

namespace Helium\LaravelHelpers\Passport\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Laravel\Passport\Token;

class HeliumPassportRefreshToken extends Token
{
    use GeneratesPrimaryKey;

    public $primaryKeyPrefix = 'PP-RTK';
}