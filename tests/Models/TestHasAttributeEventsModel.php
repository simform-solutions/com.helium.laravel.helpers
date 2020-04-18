<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasAttributeEvents;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestHasAttributeEventsModel extends Model
{
	use HasAttributeEvents;

	protected $guarded = [];
}