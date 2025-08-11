<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\VehicleSociete;

class VehicleSocieteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return match ($this->method()) {
            'POST' => $this->user()?->can('create', VehicleSociete::class),
            'PUT', 'PATCH' => $this->user()?->can('update', $this->route('vehiclessociete')),
            'DELETE' => $this->user()?->can('delete', $this->route('vehiclessociete')),
            default => true,
        };
    }

    public function rules(): array
    {
        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            return [
                'name'                     => 'sometimes|string|max:255',
                'marque'                   => 'sometimes|string|max:255',
                'model'                    => 'sometimes|string|max:255',
                'immatriculation'          => 'sometimes|string|max:20',
                'datemec'                  => 'sometimes|date',
                'usage'                    => 'sometimes|string|max:255',
                'site'                     => 'sometimes|string|max:255',
                'copiecg'                  => 'sometimes|string',
                'copieassurance'           => 'sometimes|string',
                'affectation'              => 'sometimes|string|max:255',
                'commentaire'              => 'sometimes|string',
                'datect'                   => 'sometimes|date',
                'dateprochainct'           => 'sometimes|date',
                'dateentretien'            => 'sometimes|date',
                'dateprochainentretien'    => 'sometimes|date',
            ];
        }

        return [
            'name'                     => 'required|string|max:255',
            'marque'                   => 'nullable|string|max:255',
            'model'                    => 'nullable|string|max:255',
            'immatriculation'          => 'required|string|max:20',
            'datemec'                  => 'nullable|date',
            'usage'                    => 'nullable|string|max:255',
            'site'                     => 'nullable|string|max:255',
            'copiecg'                  => 'nullable|string',
            'copieassurance'           => 'nullable|string',
            'affectation'              => 'nullable|string|max:255',
            'commentaire'              => 'nullable|string',
            'datect'                   => 'nullable|date',
            'dateprochainct'           => 'nullable|date',
            'dateentretien'            => 'nullable|date',
            'dateprochainentretien'    => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                  => 'Le nom du véhicule est obligatoire.',
            'marque.required'                => 'La marque est requise.',
            'model.required'                 => 'Le modèle est requis.',
            'immatriculation.required'       => 'L\'immatriculation est obligatoire.',
            'datemec.required'               => 'La date de mise en circulation est obligatoire.',
            'usage.required'                 => 'Le champ usage est requis.',
            'site.required'                  => 'Le site est obligatoire.',
            'affectation.required'           => 'L\'affectation est requise.',
            'datect.date'                    => 'La date de contrôle technique doit être valide.',
            'dateprochainct.date'            => 'La date du prochain contrôle technique doit être valide.',
            'dateentretien.date'             => 'La date d\'entretien doit être valide.',
            'dateprochainentretien.date'     => 'La date du prochain entretien doit être valide.',
        ];
    }
}
