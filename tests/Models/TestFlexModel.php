<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\FlexModel;
use Tests\Models\Base\TestModel;

class TestFlexModel extends TestModel
{
	use FlexModel;

	public $flexColumn = null;

	protected $casts = [
		'flex_array' => 'array'
	];
}