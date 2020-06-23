<?php

namespace Tests\TestModels;

use Tests\TestModels\Base\TestModel;

class TestSearchModel extends TestModel
{
	protected $fillable = [
		'age',
        'parent_id'
	];

	public function parent()
    {
        return $this->belongsTo(TestSearchModel::class, 'parent_id');
    }
}