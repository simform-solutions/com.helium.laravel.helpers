<?php

namespace Helium\LaravelHelpers\Middleware;

use Closure;
use Illuminate\Support\Str;

class CastCamelCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->castCamelToSnake($request);

        return $next($request);
    }

    protected function castCamelToSnake($request)
    {
        $snake = [];

        foreach ($request->all() as $key => $value)
        {
            $snake[Str::snake($key)] = $value;
        }

        $request->merge($snake);
    }
}
