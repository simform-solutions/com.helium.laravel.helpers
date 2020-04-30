<?php

namespace Helium\LaravelHelpers\Handlers;

use Helium\LaravelHelpers\Exceptions\InternalServerException;
use Helium\LaravelHelpers\Exceptions\UserException;
use Helium\LaravelHelpers\Resources\ApiErrorResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Validation\UnauthorizedException;
use Throwable;

class ApiExceptionHandler extends Handler
{
	public function render($request, Throwable $e)
	{
		if (config('app.debug') ||
			$e instanceof UserException ||
			$e instanceof UnauthorizedException ||
			$e instanceof AuthenticationException)
		{
			return new ApiErrorResource($e);
		}
		else
		{
			return new ApiErrorResource(new InternalServerException($e));
		}
	}
}