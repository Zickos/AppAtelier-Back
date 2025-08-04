<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vehicle;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return match ($this->method()) {
            'POST' => $this->user()?->can('create', Vehicle::class),
            'PUT', 'PATCH' => $this->user()?->can('update', $this->route('vehicle')),
            'DELETE' => $this->user()?->can('delete', $this->route('vehicle')),
            default => true,
        };
    }

    public function rules(): array
    {
        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            // 🔁 Mise à jour partielle, avec gestion de l'unicité du num_serie
            $vehicleId = $this->route('vehicle')->id ?? null;

            return [
                'name'             => 'sometimes|string|max:255',
                'marque'  => 'sometimes|string',
                'id_client'        => 'sometimes|string',
                'owner'            => 'sometimes|string',
                'num_serie'        => 'sometimes|unique:vehicles,num_serie,' . $vehicleId,
                'type_vehicle_id'  => 'sometimes|exists:type_vehicles,id',
            ];
        }

        // 🆕 Création
        return [
            'name'             => 'required|string|max:255',
            'id_client'        => 'required|string',
            'owner'            => 'required|string',
            'num_serie'        => 'required|unique:vehicles,num_serie',
            'type_vehicle_id'  => 'required|exists:type_vehicles,id',
            'marque'  => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'marque.required'             => 'La marque du véhicule est obligatoire.',
            'name.required'             => 'Le nom du véhicule est obligatoire.',
            'id_client.required'        => 'Le champ "ID client" est obligatoire.',
            'id_client.string'          => 'Le champ "ID client" doit être une chaîne de caractères.',
            'owner.required'            => 'Le propriétaire est requis.',
            'owner.string'              => 'Le nom du propriétaire doit être une chaîne.',
            'num_serie.required'        => 'Le numéro de série est obligatoire.',
            'num_serie.unique'          => 'Ce numéro de série est déjà utilisé.',
            'type_vehicle_id.required'  => 'Le type de véhicule est requis.',
            'type_vehicle_id.exists'    => 'Le type de véhicule sélectionné est invalide.',
            'type_vehicle_id.exists'    => 'Le type de véhicule sélectionné est invalide.',
        ];
    }
}
