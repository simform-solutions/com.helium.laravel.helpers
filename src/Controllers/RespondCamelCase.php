<?php

namespace Helium\LaravelHelpers\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

trait RespondCamelCase
{
    public function callAction($method, $parameters)
    {
        return $this->attemptCamelCaseJson($this->{$method}(...array_values($parameters)));
    }

    public function attemptCamelCaseJson($rawResponse): Response
    {
        $response = Router::toResponse(request(), $rawResponse);

        if ($response instanceof JsonResponse)
        {
            $response->setData($this->recursiveCamelKeys($response->getData(true)));
        }

        return $response;
    }

    /**
     * @param $json
     * @return mixed
     */
    protected function recursiveCamelKeys($json)
    {
        if (is_array($json)) {
            $newJson = [];
            foreach ($json as $key => $value) {
                $newValue = $this->recursiveCamelKeys($value);
                if (is_string($key) && !array_key_exists(Str::camel($key), $json)) {
                    $newJson[Str::camel($key)] = $newValue;
                } else {
                    $newJson[$key] = $newValue;
                }
            }

            return $newJson;
        }

        return $json;
    }
}