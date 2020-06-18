<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Tests\TestModels\TestBatchActionsModel;

class BatchActionsTest extends TestCase
{
	public function testBatchCreate()
	{
		$return = DB::table('test_batch_actions_models')->insert([
			['data' => 'abc'],
			['data' => '123'],
			['data' => 'do re mi']
		]);

		dd($return);
	}
}