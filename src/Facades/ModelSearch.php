<?php

namespace Helium\LaravelHelpers\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ModelSearch
{
	protected const FILTER_OPERATORS = [
		'lt' => '<',
		'lte' => '<=',
		'eq' => '=',
		'gte' => '>=',
		'gt' => '>',
		'like' => 'LIKE'
	];

	public static function search(Builder $query,
		array $params): LengthAwarePaginator
	{
	    $query->with($params['relations'], []);

		$orderBy = array_key_exists('order_by', $params) ? $params['order_by'] : [];
		foreach ($orderBy as $column => $direction)
		{
			$query->orderBy($column, $direction);
		}

		$filters = array_key_exists('filters', $params) ? $params['filters'] : [];
		foreach ($filters as $column => $columnFilters)
		{
			foreach ($columnFilters as $operator => $value)
			{
				$query->where(
					$column,
					self::FILTER_OPERATORS[$operator],
					$value
				);
			}
		}

		$perPage = array_key_exists('per_page', $params) ?
			$params['per_page'] : null;
		$page = array_key_exists('page', $params) ?
			$params['page'] : null;

		$list = $query->paginate(
			//If per_page is null, it will default to 15 inside the paginate function
			$perPage,
			['*'], //Default argument in paginate function, needed to pass page arg
			'page', //Default argument in paginate function, needed to pass page arg
			$page
		);

		if ($perPage)
		{
			$list->appends('per_page', $perPage);
		}

		return $list;
	}
}