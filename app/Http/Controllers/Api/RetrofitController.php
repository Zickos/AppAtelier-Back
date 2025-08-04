<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RetrofitResource;
use App\Models\Retrofit;
use Illuminate\Http\Request;
use App\Http\Requests\RetrofitRequest;

class RetrofitController extends Controller
{
    /**
     * Liste tous les retrofits avec les relations utiles.
     */
    public function index()
    {
        $retrofits = Retrofit::with(['vehicle', 'typesTravaux', 'demandes', 'photo', 'plannings'])->get();
        return RetrofitResource::collection($retrofits);
    }

    /**
     * Crée un nouveau retrofit.
     */
    public function store(RetrofitRequest $request)
    {
        $retrofit = Retrofit::create($request->validated());

        if ($request->has('type_travail_ids')) {
            $retrofit->typesTravaux()->sync($request->type_travail_ids);
        }

        return new RetrofitResource($retrofit->load(['vehicle', 'typesTravaux']));
    }

    /**
     * Affiche un retrofit donné.
     */
    public function show(Retrofit $retrofit)
    {
        return new RetrofitResource(
            $retrofit->load(['vehicle', 'typesTravaux', 'demandes', 'photo', 'plannings'])
        );
    }

    /**
     * Met à jour un retrofit.
     */
    public function update(RetrofitRequest $request, Retrofit $retrofit)
    {
        $retrofit->update($request->validated());

        if ($request->has('type_travail_ids')) {
            $retrofit->typesTravaux()->sync($request->type_travail_ids);
        }

        return new RetrofitResource($retrofit->load(['vehicle', 'typesTravaux']));
    }

    /**
     * Supprime un retrofit.
     */
    public function destroy(Retrofit $retrofit)
    {
        $retrofit->delete();
        return response()->json(null, 204);
    }
}
