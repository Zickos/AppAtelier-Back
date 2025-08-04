<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Http\Requests\PlanningRequest;
use App\Http\Resources\PlanningResource;

class PlanningController extends Controller
{
    /**
     * Liste tous les plannings avec relations.
     */
    public function index()
    {
        $plannings = Planning::with(['vehicle', 'retrofit', 'users', 'vehicle.typeVehicle'])->get();
        return PlanningResource::collection($plannings);
    }

    protected function getPlanningsWithCondition(?bool $hasVehicleRetrofit = true)
    {
        $query = Planning::with(['users']);

        if ($hasVehicleRetrofit) {
            $query->with(['vehicle', 'retrofit', 'vehicle.typeVehicle'])
                ->whereNotNull('vehicle_id')
                ->whereNotNull('retrofit_id');
        } else {
            $query->whereNull('vehicle_id')
                ->whereNull('retrofit_id');
        }

        return PlanningResource::collection($query->get());
    }




    public function indexMecano()
    {
        return $this->getPlanningsWithCondition(true);
    }


    public function indexMagasin()
    {
        return $this->getPlanningsWithCondition(false);
    }


    /**
     * Crée un nouveau planning.
     */
    public function store(PlanningRequest $request)
    {
        $planning = Planning::create($request->validated());

        if ($request->has('user_ids')) {
            $planning->users()->sync($request->user_ids);
        }

        return new PlanningResource($planning->load(['vehicle', 'retrofit', 'users']));
    }

    /**
     * Affiche un planning donné.
     */
    public function show(Planning $planning)
    {
        return new PlanningResource(
            $planning->load(['vehicle', 'retrofit', 'users'])
        );
    }

    /**
     * Met à jour un planning.
     */
    public function update(PlanningRequest $request, Planning $planning)
    {
        $planning->update($request->validated());

        if ($request->has('user_ids')) {
            $planning->users()->sync($request->user_ids);
        }

        return new PlanningResource($planning->load(['vehicle', 'retrofit', 'users']));
    }

    /**
     * Supprime un planning.
     */
    public function destroy(Planning $planning)
    {
        $planning->delete();
        return response()->json(null, 204);
    }
}
