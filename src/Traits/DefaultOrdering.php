<?php

namespace Helium\LaravelHelpers\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DefaultOrdering
{
	protected function defaultOrderings(): array
	{
		return property_exists($this, 'defaultOrderings') ?
			$this->defaultOrderings : ['updated_at' => 'desc'];
	}

	public static function bootDefaultOrdering()
	{
		static::addGlobalScope('defaultOrdering', function (Builder $builder) {
			$defaultOrderings = (new static)->defaultOrderings();

			foreach ($defaultOrderings as $key => $direction)
			{
				$builder = $builder->orderBy($key, $direction);
			}

			return $builder;
		});
	}
}