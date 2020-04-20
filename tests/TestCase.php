<?php

namespace Tests;

use Exception;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	use SetsUpTests;

	protected function assertThrowsException(callable $callback, string $exceptionClass = null)
	{
		$exceptionClass = $exceptionClass ?? Exception::class;
		$assertionMessage = "Failed to assert that {$exceptionClass} was thrown";

		try
		{
			$callback();

			$this->assertTrue(false, $assertionMessage);
		}
		catch (Exception $e)
		{
			$assertionMessage .= ', got ' . get_class($e);
			$this->assertInstanceOf($exceptionClass, $e, $assertionMessage);
		}
	}
}