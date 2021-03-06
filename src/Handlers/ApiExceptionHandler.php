<?php

namespace Helium\LaravelHelpers\Handlers;

use Helium\LaravelHelpers\Exceptions\ApiException;
use Helium\LaravelHelpers\Exceptions\InternalServerException;
use Helium\LaravelHelpers\Resources\ApiErrorResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Helium\LaravelHelpers\Exceptions\ValidationException as HeliumValidationException;
use Throwable;

class ApiExceptionHandler extends Handler
{
	public function render($request, Throwable $e)
	{
	    if ($e instanceof ValidationException) {
	        $e = new HeliumValidationException($e);
        }

	    if ($e instanceof HttpException) {
	        $statusCode = $e->getStatusCode();
        }
		elseif ($e instanceof AuthenticationException ||
			$e instanceof AuthorizationException ||
			$e instanceof UnauthorizedException)
		{
			$statusCode = Response::HTTP_UNAUTHORIZED;
		}
		elseif ($e instanceof ModelNotFoundException)
		{
			$statusCode = Response::HTTP_NOT_FOUND;
		}
		elseif ($e instanceof ApiException)
		{
			$statusCode = $e->httpStatusCode;
		}
		else
		{
			$statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
		}

		if (config('app.debug') ||
			$e instanceof ApiException ||
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