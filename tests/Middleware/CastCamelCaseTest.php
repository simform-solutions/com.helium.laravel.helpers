<?php

namespace Tests\Middleware;

use Helium\LaravelHelpers\Middleware\CastCamelCase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CastCamelCaseTest extends TestCase
{
    public function testCastCamelCase()
    {
        $middleware = new CastCamelCase;
        $request = new Request;

        $request->merge([
            'someAttribute' => 'abc'
        ]);

        $middleware->handle($request, function($req) {
            $this->assertArrayHasKey('someAttribute', $req->all());
            $this->assertArrayHasKey('some_attribute', $req->all());
            $this->assertEquals($req->someAttribute, $req->some_attribute);
        });
    }
}