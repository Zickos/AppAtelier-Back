<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\TypeVehicle;
use App\Models\Retrofit;
use App\Models\Planning;
use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\Attributes\Test;


class VehicleModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function vehicle_belongs_to_type_vehicle()
    {
        $type = TypeVehicle::factory()->create();
        $vehicle = Vehicle::factory()->create(['type_vehicle_id' => $type->id]);

        $this->assertTrue($vehicle->typeVehicle->is($type));
    }

    #[Test]
    public function vehicle_can_have_multiple_plannings()
    {
        $vehicle = Vehicle::factory()->create();
        $plannings = Planning::factory()->count(5)->create(['vehicle_id' => $vehicle->id]);

        $this->assertCount(5, $vehicle->plannings);
        foreach ($plannings as $planning) {
            $this->assertTrue($vehicle->plannings->contains($planning));
        }
    }

    #[Test]
    public function vehicle_does_not_contain_foreign_plannings()
    {
        $vehicleA = Vehicle::factory()->create();
        $vehicleB = Vehicle::factory()->create();

        $planningA = Planning::factory()->create(['vehicle_id' => $vehicleA->id]);
        $planningB = Planning::factory()->create(['vehicle_id' => $vehicleB->id]);

        $this->assertTrue($vehicleA->plannings->contains($planningA));
        $this->assertFalse($vehicleA->plannings->contains($planningB));
    }

    #[Test]
    public function vehicle_has_many_retrofits()
    {
        $vehicle = Vehicle::factory()->create();
        $retrofits = Retrofit::factory()->count(3)->create(['vehicle_id' => $vehicle->id]);

        $this->assertCount(3, $vehicle->retrofits);
        foreach ($retrofits as $retrofit) {
            $this->assertTrue($vehicle->retrofits->contains($retrofit));
        }
    }

    #[Test]
    public function vehicle_does_not_include_other_retrofits()
    {
        $vehicleA = Vehicle::factory()->create();
        $vehicleB = Vehicle::factory()->create();

        $retrofitA = Retrofit::factory()->create(['vehicle_id' => $vehicleA->id]);
        $retrofitB = Retrofit::factory()->create(['vehicle_id' => $vehicleB->id]);

        $this->assertTrue($vehicleA->retrofits->contains($retrofitA));
        $this->assertFalse($vehicleA->retrofits->contains($retrofitB));
    }

    #[Test]
    public function vehicle_fillable_fields_are_correct()
    {
        $vehicle = new Vehicle();

        $this->assertEquals([
            'id_client',
            'owner',
            'num_serie',
            'type_vehicle_id',
        ], $vehicle->getFillable());
    }

    #[Test]
    public function vehicle_hidden_fields_are_correct()
    {
        $vehicle = new Vehicle();

        $this->assertEquals([
            'created_at',
            'updated_at',
        ], $vehicle->getHidden());
    }

    #[Test]
    public function vehicle_casts_are_correct()
    {
        $vehicle = new Vehicle();

        $this->assertArrayHasKey('created_at', $vehicle->getCasts());
        $this->assertEquals('datetime', $vehicle->getCasts()['created_at']);
    }

    #[Test]
    public function vehicle_can_belong_to_different_type_categories()
    {
        $names = ['TMX', 'ABS', 'Charlatte', 'Fenwick', 'Autre'];

        foreach ($names as $name) {
            $type = TypeVehicle::factory()->create(['name' => $name]);
            $vehicle = Vehicle::factory()->create(['type_vehicle_id' => $type->id]);

            $this->assertEquals($name, $vehicle->typeVehicle->name);
        }
    }

    #[Test]
    public function it_formats_owner_with_mutator()
    {
        $vehicle = Vehicle::factory()->create([
            'owner' => 'tItOUan zICKLER',
        ]);

        $this->assertEquals('Titouan Zickler', $vehicle->owner);
    }

    #[Test]
    public function it_returns_combined_full_id_with_accessor()
    {
        $vehicle = Vehicle::factory()->make([
            'id_client' => 'abc123',
            'num_serie' => 'XYZ-9876',
        ]);

        $this->assertEquals('ABC123-XYZ-9876', $vehicle->full_id);
    }

/*     #[Test]
    public function it_can_filter_vehicles_by_owner_using_scope()
    {
        Vehicle::factory()->create(['owner' => 'Jean Dupont']);
        Vehicle::factory()->create(['owner' => 'Alice Durant']);

        $filtered = Vehicle::ownedBy('Jean Dupont')->get();

        $this->assertCount(1, $filtered);
        $this->assertEquals('Jean Dupont', $filtered->first()->owner);
    }

    #[Test]
    public function it_can_filter_vehicles_by_type_vehicle_id_using_scope()
    {
        $type1 = TypeVehicle::factory()->create();
        $type2 = TypeVehicle::factory()->create();

        Vehicle::factory()->create(['type_vehicle_id' => $type1->id]);
        Vehicle::factory()->create(['type_vehicle_id' => $type2->id]);

        $filtered = Vehicle::ofType($type1->id)->get();

        $this->assertCount(1, $filtered);
        $this->assertEquals($type1->id, $filtered->first()->type_vehicle_id);
    } */
}
