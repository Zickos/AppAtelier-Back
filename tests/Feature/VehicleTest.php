<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\TypeVehicle;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\Attributes\Test;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Models\User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $role = Role::factory()->create(['name' => 'Admin']);
        $this->user = User::factory()->create(['role_id' => $role->id]);
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_list_vehicles()
    {
        Vehicle::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/vehicles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'id_client', 'owner', 'num_serie']
                ]
            ]);
    }

    #[Test]
    public function it_can_create_a_vehicle()
    {
        $type = TypeVehicle::factory()->create();

        $payload = [
            'id_client' => '123-abc',
            'owner' => 'Titouan Zickler',
            'num_serie' => 'XYZ9876',
            'type_vehicle_id' => $type->id,
        ];

        $response = $this->actingAs($this->user)->postJson('/api/vehicles', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'id_client' => '123-abc',
                'owner' => 'Titouan Zickler',
                'num_serie' => 'XYZ9876',
            ]);

        $this->assertDatabaseHas('vehicles', [
            'num_serie' => 'XYZ9876',
        ]);
    }

    #[Test]
    public function it_can_update_a_vehicle()
    {
        $type = \App\Models\TypeVehicle::factory()->create();
        $vehicle = \App\Models\Vehicle::factory()->create([
            'id_client' => 'A-123',
            'owner' => 'John Doe',
            'num_serie' => '123XYZ',
            'type_vehicle_id' => $type->id,
        ]);

        $updateData = [
            'owner' => 'Jane Smith',
            'num_serie' => 'NEW456',
        ];

        $response = $this->actingAs($this->user)->putJson("/api/vehicles/{$vehicle->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'owner' => 'Jane Smith',
                'num_serie' => 'NEW456',
            ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'owner' => 'Jane Smith',
            'num_serie' => 'NEW456',
        ]);
    }

    #[Test]
    public function it_can_delete_a_vehicle()
    {
        $vehicle = \App\Models\Vehicle::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/vehicles/{$vehicle->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id,
        ]);
    }

    #[Test]
    public function it_fails_to_create_duplicate_vehicle()
    {
        $type = TypeVehicle::factory()->create();
        $existing = Vehicle::factory()->create([
            'num_serie' => 'DUPLICATE-001',
            'type_vehicle_id' => $type->id,
        ]);

        $payload = [
            'id_client' => 'abc123',
            'owner' => 'Another Owner',
            'num_serie' => 'DUPLICATE-001',
            'type_vehicle_id' => $type->id,
        ];

        $response = $this->actingAs($this->user)->postJson('/api/vehicles', $payload);

        $response->assertStatus(422); // Laravel returns 422 on validation failure
        $response->assertJsonValidationErrors(['num_serie']);
    }
}
