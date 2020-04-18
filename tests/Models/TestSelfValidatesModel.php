<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestSelfValidatesModel extends Model
{
	use SelfValidates;

	protected $guarded = [];

	public $validatesOnSave = false;

	public $validationRules = [
		'string' => 'required|string',
		'int' => 'required|integer',
		'bool' => 'required|boolean',
		'foreign_key' => 'required|exists:test_generates_primary_key_models,id'
	];

	public $validationMessages = [
		'string.required' => 'string required',
		'string.string' => 'string string',
		'int.required' => 'int required',
		'int.integer' => 'int integer',
		'bool.required' => 'bool required',
		'bool.boolean' => 'bool boolean',
		'foreign_key.required' => 'foreign_key required',
		'foregin_key.exists' => 'foreign_key exists'
	];
}