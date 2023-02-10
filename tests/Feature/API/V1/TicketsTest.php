<?php

namespace Tests\Feature\API\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_new_ticket()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/apiticketstore',[
            'customer_name' => 'isuri',
            'email' => 'isuri@gmail.com',
            'contact_number' => '0775675674',
            'description' => 'dfdsfsdfs'
        ]);

        $response->assertStatus(200);
    }

    public function test_all_tickets()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/v1/apitickets');

        $response->assertStatus(200);
    }

    public function test_ticket_update()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/apiticket/update/{id}',[
            'id'=>1,
            'customer_name' => 'isuri',
            'email' => 'isuri@gmail.com',
            'contact_number' => '0775675674',
            'description' => 'dfdsfsdfs'
        ]);

        $response->assertStatus(200);
    }

    public function test_ticket_delete()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/v1/apiticket/destroy/{id}',[
            'id'=>1,
            'customer_name' => 'isuri',
            'email' => 'isuri@gmail.com',
            'contact_number' => '0775675674',
            'description' => 'dfdsfsdfs'
        ]);

        $response->assertStatus(200);
    }
}
