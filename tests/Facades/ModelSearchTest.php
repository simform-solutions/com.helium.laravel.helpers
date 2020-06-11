<?php

namespace Tests\Facades;

use Helium\LaravelHelpers\Facades\ModelSearch;
use Tests\TestCase;
use Tests\TestModels\TestSearchModel;

class ModelSearchTest extends TestCase
{
	public function testSearch()
	{
		factory(TestSearchModel::class, 5)->create([
			'age' => 16
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 20
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 25
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 30
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 35
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 40
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 45
		]);

		factory(TestSearchModel::class, 5)->create([
			'age' => 90
		]);

		$list = ModelSearch::search(TestSearchModel::query(), [
			'filters' => [
				'age' => [
					'gt' => 18,
					'lt' => 65
				]
			],
			'order_by' => [
				'age' => 'asc'
			],
			'per_page' => 10,
			'page' => 2
		])->toArray();

		//Test per_page
		$this->assertCount(10, $list['data']);
		$this->assertEquals(10, $list['per_page']);
		$this->assertStringContainsString('per_page=10', $list['first_page_url']);
		$this->assertStringContainsString('per_page=10', $list['last_page_url']);
		$this->assertStringContainsString('per_page=10', $list['next_page_url']);
		$this->assertStringContainsString('per_page=10', $list['prev_page_url']);

		//Test page
		$this->assertEquals(2, $list['current_page']);

		//Test filters
		$this->assertEquals(30, $list['total']);

		//Test order_by
		foreach (range(1, 9) as $i)
		{
			$this->assertLessThanOrEqual($list['data'][$i], $list['data'][$i - 1]);
		}
	}
}