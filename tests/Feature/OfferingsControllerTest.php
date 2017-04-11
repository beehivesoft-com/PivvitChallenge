<?php

namespace Tests\Feature;

use App\Offering;
use App\Purchase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfferingsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_index_route_should_exist()
    {
        $this->get('/api/offerings')
             ->assertStatus(200);
    }

    public function test_index_route_should_return_list_of_offerings()
    {
        $result = $this->get('/api/offerings');

        foreach ($result->decodeResponseJson() as $row) {
            $this->assertArrayHasKey('id', $row);
            $this->assertArrayHasKey('title', $row);
            $this->assertArrayHasKey('price', $row);
        }
    }
}
