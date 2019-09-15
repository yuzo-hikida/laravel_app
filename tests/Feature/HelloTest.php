<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithouMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class HelloTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testHello()
    {
        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/todo');
        $response->assertStatus(302);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/todo');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);


        // $arr = [];
        // $this->assertEmpty($arr);
        // $msg = "Hello";
        // $this->assertEquals('Hello', $msg);

        // $n = random_int(0, 100);
        // $this->assertLessThan(100, $n);
    }
}
