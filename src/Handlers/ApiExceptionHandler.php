<?php

namespace Helium\LaravelHelpers\Handlers;

use Helium\LaravelHelpers\Exceptions\InternalServerException;
use Helium\LaravelHelpers\Exceptions\UserException;
use Helium\LaravelHelpers\Exceptions\ValidationException;
use Helium\LaravelHelpers\Resources\ApiErrorResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Throwable;

class ApiExceptionHandler extends Handler
{
	public function render($request, Throwable $e)
	{
		if ($e instanceof AuthenticationException ||
			$e instanceof AuthorizationException ||
			$e instanceof UnauthorizedException)
		{
			$statusCode = Response::HTTP_UNAUTHORIZED;
		}
		elseif ($e instanceof ModelNotFoundException)
		{
			$statusCode = Response::HTTP_NOT_FOUND;
		}
		elseif ($e instanceof ValidationException)
		{
			$statusCode = Response::HTTP_BAD_REQUEST;
		}
		else
		{
			$statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
		}

		if (config('app.debug') ||
			$e instanceof UserException ||
			$e instanceof UnauthorizedException ||
			$e instanceof AuthorizationException ||
			$e instanceof AuthenticationException ||
			$e instanceof ModelNotFoundException)
		{
			return (new ApiErrorResource($e))
				->response()
				->setStatusCode($statusCode);
		}
		else
		{
			return (new ApiErrorResource(new InternalServerException($e)))
				->response()
				->setStatusCode($statusCode);
		}
	}
}