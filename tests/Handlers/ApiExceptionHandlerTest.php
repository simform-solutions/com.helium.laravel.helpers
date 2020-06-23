<?php

namespace Tests\Handlers;

use Exception;
use Helium\LaravelHelpers\Exceptions\InternalServerException;
use Helium\LaravelHelpers\Exceptions\ApiException;
use Helium\LaravelHelpers\Exceptions\ValidationException;
use Helium\LaravelHelpers\Handlers\ApiExceptionHandler;
use Helium\LaravelHelpers\Resources\ApiErrorResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Tests\TestCase;
use Tests\TestModels\SelfValidatesModel;

class ApiExceptionHandlerTest extends TestCase
{
	public function testDebug()
	{
		config(['app.debug' => true]);

		$handler = new ApiExceptionHandler(new Container());

		$message = 'An error occurred';
		$e = new Exception($message);

		$request = new Request();
		$response = $handler->render($request, $e);

		$this->assertEquals(500, $response->getStatusCode());

		$array = $response->getData(true);

		$this->assertCount(3, $array);

		$this->assertArrayHasKey('message', $array);
		$this->assertEquals($array['message'], $message);

		$this->assertArrayHasKey('exception_class', $array);
		$this->assertEquals(Exception::class, $array['exception_class']);

		$this->assertArrayHasKey('stack_trace', $array);
		$this->assertIsArray($array['stack_trace']);
	}

	public function testDetailedExceptions()
	{
		$exceptions = [
			new ApiException(),
			new AuthenticationException(),
			new AuthorizationException(),
			new UnauthorizedException(),
			new ModelNotFoundException()
		];

		try {
			factory(SelfValidatesModel::class)->make([
				'string' => null
			])->validate();

			$this->assertTrue(false);
		} catch (ValidationException $e) {
			$exceptions[] = $e;
		}

		foreach ($exceptions as $e)
		{
			$handler = new ApiExceptionHandler(new Container());
			$request = new Request();
			$response = $handler->render($request, $e);

			$array = $response->getData(true);

			if ($e instanceof ValidationException)
			{
				$this->assertEquals(400, $response->getStatusCode());

				$this->assertCount(2, $array);

				$this->assertArrayHasKey('messages', $array);
				$this->assertEquals($array['messages'], $e->toArray());
			}
			elseif ($e instanceof AuthenticationException ||
					$e instanceof AuthorizationException ||
					$e instanceof UnauthorizedException)
			{
				$this->assertEquals(401, $response->getStatusCode());
				$this->assertCount(1, $array);
			}
			elseif ($e instanceof ModelNotFoundException)
			{
				$this->assertEquals(404, $response->getStatusCode());
				$this->assertCount(1, $array);
			}
			else
			{
				$this->assertEquals(500, $response->getStatusCode());
				$this->assertCount(1, $array);
			}

			$this->assertArrayHasKey('message', $array);
			$this->assertEquals($array['message'], $e->getMessage());
		}
	}

	public function testGeneralException()
	{
		$handler = new ApiExceptionHandler(new Container());

		$message = 'An error occurred';
		$e = new Exception($message);
		$internalException = new InternalServerException();

		$request = new Request();
		$response = $handler->render($request, $e);

		$array = $response->getData(true);

		$this->assertCount(1, $array);

		$this->assertArrayHasKey('message', $array);
		$this->assertEquals($array['message'], $internalException->getMessage());
	}
}