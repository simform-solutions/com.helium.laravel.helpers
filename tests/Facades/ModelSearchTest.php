<?php

namespace Tests\Facades;

use Helium\LaravelHelpers\Facades\ModelSearch;
use Tests\TestCase;
use Tests\TestModels\SearchModel;

class ModelSearchTest extends TestCase
{
	public function testSearch()
	{
		factory(SearchModel::class, 5)->create([
			'age' => 16
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 20,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 25,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 30,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 35,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 40,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 45,
            'parent_id' => SearchModel::first()->id
		]);

		factory(SearchModel::class, 5)->create([
			'age' => 90,
            'parent_id' => SearchModel::first()->id
		]);

		$list = ModelSearch::search(SearchModel::query(), [
			'filters' => [
				'age' => [
					'gt' => 18,
					'lt' => 65
				]
			],
			'order_by' => [
				'age' => 'asc'
			],
			'relations' => [
			    'parent'
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

		//Test relations
        foreach($list['data'] as $datum)
        {
            $this->assertArrayHasKey('parent', $datum);

            if ($datum['age'] > 16) {
                $this->assertNotNull($datum['parent']);
                $this->assertIsArray($datum['parent']);
            } else {
                $this->assertNull($datum['parent']);
            }
        }
	}
}