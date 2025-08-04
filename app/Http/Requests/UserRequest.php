<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $routeUser = $this->route('user');

        return match ($this->method()) {
            'GET' => $routeUser
                ? $user->can('view', $routeUser)     // /users/{user}
                : $user->can('viewAny', \App\Models\User::class), // /users
            default => false,
        };
    }


    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            return [
                'prenom'   => 'sometimes|string|max:255',
                'email'    => ['sometimes', 'email', Rule::unique('users')->ignore($userId)],
                'password' => 'sometimes|string|min:6',
                'role_id'  => 'sometimes|exists:roles,id',
            ];
        }

        if ($this->isMethod('POST')) {
            return [
                'prenom'    => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|string|min:6',
                'role_id'   => 'required|exists:roles,id',
            ];
        }

        // 👇 Cela évite toute validation inutile pour GET ou DELETE
        return [];
    }


    public function messages(): array
    {
        return [
            'prenom.required'   => 'Le prénom est requis.',
            'prenom.string'     => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max'        => 'Le prénom ne peut pas dépasser 255 caractères.',
            'email.required'    => 'L’email est requis.',
            'email.email'       => 'Le format de l’email est invalide.',
            'email.unique'      => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.string'   => 'Le mot de passe doit être une chaîne de caractères.',
            'password.min'      => 'Le mot de passe doit faire au moins 6 caractères.',
            'role_id.required'  => 'Le rôle est requis.',
            'role_id.exists'    => 'Le rôle sélectionné est invalide.',
        ];
    }
}
