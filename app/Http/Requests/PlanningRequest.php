<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Planning;

class PlanningRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $routeModel = $this->route('planning');

        if (!$user) {
            return false;
        }

        logger([
            'user' => $user?->id,
            'role' => $user?->role?->name,
            'method' => $this->method(),
        ]);

        return match ($this->method()) {
            'POST'   => $user->can('create', Planning::class),
            'PUT', 'PATCH' => $user->can('update', $routeModel),
            'DELETE' => $user->can('delete', $routeModel),
            'GET'    => $routeModel
                ? $user->can('view', $routeModel)
                : $user->can('viewAny', Planning::class),
            default => false,
        };
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'date_debut'    => 'date',
            'date_fin'      => 'date|after_or_equal:date_debut',
            'commentaire'   => 'nullable|string',
            'etat'          => 'boolean',
            'vehicle_id' => '|nullable|exists:vehicles,id',
            'retrofit_id' => '|nullable|exists:retrofits,id',

            'user_ids'      => 'nullable|array',
            'user_ids.*'    => 'exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'date_debut.date'              => 'La date de début doit être une date valide.',
            'date_fin.date'                => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal'      => 'La date de fin doit être postérieure ou égale à la date de début.',
            'commentaire.string'           => 'Le commentaire doit être une chaîne de caractères.',
            'etat.boolean'                 => 'Le champ état doit être vrai ou faux.',
            'vehicle_id.required'          => 'Le véhicule est requis.',
            'vehicle_id.exists'            => 'Le véhicule sélectionné est invalide.',
            'retrofit_id.required'         => 'Le retrofit est requis.',
            'retrofit_id.exists'           => 'Le retrofit sélectionné est invalide.',
            'user_ids.array'               => 'Les utilisateurs doivent être envoyés sous forme de tableau.',
            'user_ids.*.exists'            => 'Un ou plusieurs utilisateurs sont invalides.',
        ];
    }
}
