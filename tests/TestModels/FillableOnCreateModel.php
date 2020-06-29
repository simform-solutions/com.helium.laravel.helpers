<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\FillableOnCreate;
use Tests\TestModels\Base\TestModel;

class FillableOnCreateModel extends TestModel
{
    use FillableOnCreate;

    protected $fillable = [
        'fillable_attribute'
    ];

    protected $fillableOnCreate = [
        'not_fillable_attribute'
    ];
}