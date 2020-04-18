<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestGeneratesPrimaryKeyModel extends Model
{
	use GeneratesPrimaryKey;

	public $primaryKeyPrefix = 'GPK';

	protected $guarded = [];
}