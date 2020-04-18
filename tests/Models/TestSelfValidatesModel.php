<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestSelfValidatesModel extends Model
{
	use SelfValidates;

	protected $guarded = [];
}