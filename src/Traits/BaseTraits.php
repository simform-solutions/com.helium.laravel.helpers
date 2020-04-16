<?php

namespace Helium\LaravelHelpers\Traits;

use Czim\NestedModelUpdater\Traits\NestedUpdatable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait BaseTraits
{
	use GeneratesPrimaryKey;
	use NestedUpdatable;
	use SelfValidates;
	use SoftDeletes;
}