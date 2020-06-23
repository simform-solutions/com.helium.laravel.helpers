<?php

namespace Tests\TestModels;

use Tests\TestModels\Base\TestModel;

class SearchModel extends TestModel
{
	protected $fillable = [
		'age',
        'parent_id'
	];

	public function parent()
    {
        return $this->belongsTo(SearchModel::class, 'parent_id');
    }
}