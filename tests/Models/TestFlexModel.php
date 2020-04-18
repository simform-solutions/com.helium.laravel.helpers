<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\FlexModel;
use Illuminate\Database\Eloquent\Model;

class TestFlexModel extends Model
{
	use FlexModel;

	protected $guarded = [];

	protected $casts = [
		'flex_array' => 'array'
	];
}