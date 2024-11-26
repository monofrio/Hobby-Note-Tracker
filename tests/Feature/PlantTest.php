<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Plant;
use Illuminate\Support\Facades\Schema;

class PlantTest extends TestCase
{
    use RefreshDatabase;

    public function it_checks_if_migrations_are_running()
    {
        $this->assertTrue(Schema::hasTable('plants'), 'Migrations are not running: plants table does not exist.');
    }

    /** @test */
    public function it_checks_if_plant_table_exists()
    {
        // Ensure the 'plants' table exists
        $this->assertTrue(Schema::hasTable('plants'), 'The plants table does not exist.');
    }

    /** @test */
    public function it_can_create_a_plant()
    {
        $response = $this->post('/plants', [
            'name' => 'Test Plant',
            'description' => 'A test description',
            'location_type' => 'indoor',
            'quantity' => 1,
            'start_type' => 'seed',
        ]);

        // Assert a redirect occurred
        $response->assertStatus(302);

        // Check that the plant was added to the database
        $this->assertDatabaseHas('plants', ['name' => 'Test Plant']);
    }
}
