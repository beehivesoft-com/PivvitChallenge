<?php

namespace Tests\Feature;

use App\Offering;
use App\Purchase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchasesControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_index_route_should_exist()
    {
        $this->get('/api/purchases')
             ->assertStatus(200);
    }

    public function test_index_route_should_return_list_of_purchases()
    {
        $result = $this->get('/api/purchases');

        foreach ($result->decodeResponseJson() as $row) {
            $this->assertArrayHasKey('id', $row);
            $this->assertArrayHasKey('quantity', $row);
            $this->assertArrayHasKey('total_price', $row);

            $this->assertArrayHasKey('offering', $row);

            $offering = $row['offering'];

            $this->assertArrayHasKey('title', $offering);
            $this->assertArrayHasKey('price', $offering);
        }
    }

    public function test_store_route_should_fail_if_required_fields_do_not_exist()
    {
        $expected = [
            'error' => [
                'message' => 'The given data failed to pass validation.',
                'status' => 400
            ]
        ];

        $this->post('/api/purchases', [])
             ->assertStatus(400)
             ->assertExactJson($expected);
    }

    public function test_store_should_return_code_201_and_new_mode_if_purchase_has_been_successfully_created()
    {
        $payload = factory(Purchase::class)->raw([
            'offering_id' => Offering::pluck('id')->shuffle()->first()
        ]);

        $this->post('/api/purchases', $payload)
             ->assertStatus(201)
             ->assertJsonFragment($payload);
    }
}
