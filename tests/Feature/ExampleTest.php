<?php

namespace Tests\Feature;

use App\Http\Controllers\ExampleController;
use App\Services\Elastic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_hard_dependency()
    {
        Mockery::mock('overload:' . Elastic::class)->shouldReceive('fetchFromElastic')->once()->andReturn('ini akal akalan ciky');

        $response = $this->get('/hard');

        $response->assertJson([
            "message" => "this hard dependency"
        ]);
    }
    
    public function test_dependency_injection()
    {
        $this->instance(
            Elastic::class,
            Mockery::mock(Elastic::class, function (MockInterface $mock) {
                $mock->shouldReceive('fetchFromElastic')->once()->andReturn("this hard dependency");
            })
        );

        $response = $this->get('/injection');

        $response->assertJson([
            "message" => "ini akal akalan ciky"
        ]);
    }
}
