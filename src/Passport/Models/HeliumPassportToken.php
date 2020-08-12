<?php

namespace Helium\LaravelHelpers\Passport\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Laravel\Passport\Token;

class HeliumPassportToken extends Token
{
    use GeneratesPrimaryKey;

    public $primaryKeyPrefix = 'PP-TOK';
}