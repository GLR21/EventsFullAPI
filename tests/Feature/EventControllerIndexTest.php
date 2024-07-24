<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Fazer a requisição para a rota /events
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN')
        ])->getJson('/api/v1/events');

        // Verificar se o status da resposta é 200 (OK)
        $response->assertStatus(200);
    }
}
