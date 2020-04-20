<?php

namespace Helium\LaravelHelpers\Traits;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Czim\NestedModelUpdater\Traits\NestedUpdatable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HeliumBaseTraits
{
	use GeneratesPrimaryKey;
	use HasAttributeEvents;
	use HasEnums;
	use NestedUpdatable;
	use SelfValidates;
	use SoftDeletes;
	use SoftCascadeTrait;
}