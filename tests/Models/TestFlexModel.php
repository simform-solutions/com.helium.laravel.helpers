<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\FlexModel;
use Tests\Models\Base\TestModel;

class TestFlexModel extends TestModel
{
	use FlexModel;

	protected $casts = [
		'flex_array' => 'array'
	];
}