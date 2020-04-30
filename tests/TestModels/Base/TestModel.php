<?php

namespace Tests\TestModels\Base;

use Illuminate\Database\Eloquent\Model;

abstract class TestModel extends Model
{
	protected $guarded = [];
}