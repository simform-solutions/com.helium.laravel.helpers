<?php

namespace Helium\LaravelHelpers\Middleware;

use Closure;
use Illuminate\Support\Str;

class CastCamelToSnake
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

        $requestArray = $request->all();
        foreach ($requestArray as $key => $value)
        {
            $snakeKey = Str::snake($key);

            if (!array_key_exists($snakeKey, $requestArray)) {
                $snake[$snakeKey] = $value;
            }
        }

        $request->merge($snake);
    }
}
