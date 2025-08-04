<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Retrofit;

class RetrofitRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $routeModel = $this->route('retrofit');

        if (!$user) {
            return false;
        }

        return match ($this->method()) {
            'POST'   => $user->can('create', Retrofit::class),
            'PUT', 'PATCH' => $user->can('update', $routeModel),
            'DELETE' => $user->can('delete', $routeModel),
            'GET'    => $routeModel
                ? $user->can('view', $routeModel)
                : $user->can('viewAny', Retrofit::class),
            default => false,
        };
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'etat'              => 'boolean',
            'commentaire'       => 'nullable|string',
            'numero'       => 'string',
            'date'              => 'date',
            'vehicle_id'        => ($isUpdate ? 'sometimes' : 'required') . '|exists:vehicles,id',
            'type_travail_ids'   => 'nullable|array',
            'type_travail_ids.*' => 'exists:type_travails,id',
        ];
    }

    public function messages(): array
    {
        return [
            'etat.boolean'                 => 'Le champ "état" doit être vrai ou faux.',
            'commentaire.string'           => 'Le commentaire doit être une chaîne de caractères.',
            'numero.string'                => 'Le numéro doit être une chaîne de caractères.',
            'date.date'                    => 'La date fournie est invalide.',
            'vehicle_id.required'          => 'Le véhicule est requis.',
            'vehicle_id.exists'            => 'Le véhicule sélectionné est invalide.',
            'type_travail_ids.array'       => 'Les types de travaux doivent être une liste.',
            'type_travail_ids.*.exists'    => 'Un ou plusieurs types de travaux sont invalides.',
        ];
    }
}
