<?php

namespace Helium\LaravelHelpers\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
	public $statusCode;

	public function __construct($message = "", $httpStatusCode = 500)
	{
		$this->httpStatusCode;
		parent::__construct($message);

		//TODO: I18n translate message automatically
	}
}