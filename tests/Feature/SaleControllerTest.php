<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_sales_page_can_be_viewed(): void
    {
        $user = User::factory()->create();

        $sale = Sale::factory()->create();

        $this->actingAs($user)
            ->get('/sales')
            ->assertOk()
            ->assertViewHas('sales.0.quantity', $sale->quantity);
    }

    public function test_a_sale_can_be_recorded(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/sales', [
                'quantity' => 1,
                'unit_cost' => 10,
            ])->assertRedirect();

        $this->assertDatabaseHas(Sale::class, [
            'quantity' => 1,
            'unit_cost' => 1000,
            'selling_price' => 2334,
        ]);
    }
}
