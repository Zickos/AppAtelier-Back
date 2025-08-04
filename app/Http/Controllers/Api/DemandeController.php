<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Http\Requests\DemandeRequest;
use App\Http\Resources\DemandeResource;

class DemandeController extends Controller
{
    /**
     * Liste toutes les demandes avec relations.
     */
    public function index()
    {
        $demandes = Demande::with(['user', 'retrofit'])->get();
        return DemandeResource::collection($demandes);
    }
    /**
     * Crée une nouvelle demande.
     */
    public function store(DemandeRequest $request)
    {
        $demande = Demande::create($request->validated());

        return new DemandeResource($demande->load(['user', 'retrofit']));
    }

    /**
     * Affiche une demande spécifique.
     */
    public function show(Demande $demande)
    {
        return new DemandeResource($demande->load(['user', 'retrofits']));
    }

    /**
     * Met à jour une demande existante.
     */
    public function update(DemandeRequest $request, Demande $demande)
    {
        $demande->update($request->validated());

        return new DemandeResource($demande->load(['user', 'retrofit']));
    }

    /**
     * Supprime une demande.
     */
    public function destroy(Demande $demande)
    {
        $demande->delete();
        return response()->json(null, 204);
    }
}
