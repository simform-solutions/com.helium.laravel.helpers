<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasEnums;
use Helium\LaravelHelpers\Traits\HeliumBaseTraits;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestHeliumBaseTraitsModel extends Model
{
	use HeliumBaseTraits;
}