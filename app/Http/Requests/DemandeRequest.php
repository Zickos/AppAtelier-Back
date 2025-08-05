<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Demande;
use Illuminate\Validation\Rule;

class DemandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $routeModel = $this->route('demande');

        if (!$user) {
            return false;
        }

        return match ($this->method()) {
            'POST'   => $user->can('create', Demande::class),
            'PUT', 'PATCH' => $user->can('update', $routeModel),
            'DELETE' => $user->can('delete', $routeModel),
            'GET'    => $routeModel
                ? $user->can('view', $routeModel)
                : $user->can('viewAny', Demande::class),
            default => false,
        };
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'user_id'       => ($isUpdate ? 'sometimes' : 'required') . '|exists:users,id',
            'date'          => 'nullable|date',
            'commentaire'   => 'nullable|string',
            'etat'          => 'boolean',
            'type'          => ['required', Rule::in(['Commande', 'Retrait', 'Maintenance', 'Livraison'])],
            'retrofit_id'   => 'nullable|exists:retrofits,id', // ✅ ICI
        ];
    }


    public function messages(): array
    {
        return [
            'user_id.required'         => 'L’utilisateur est requis.',
            'user_id.exists'           => 'L’utilisateur sélectionné est invalide.',
            'date.date'                => 'Le format de date est invalide.',
            'type.in'                => 'Le type de demande est requis.',
            'commentaire.string'       => 'Le commentaire doit être une chaîne de caractères.',
            'etat.boolean'             => 'Le champ "état" doit être vrai ou faux.',
            'retrofit_id.exists' => 'Le retrofit sélectionné est invalide.',
        ];
    }
}
