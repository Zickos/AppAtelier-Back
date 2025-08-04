<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Photo;

class PhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $routeModel = $this->route('photo');

        if (!$user) {
            return false;
        }

        return match ($this->method()) {
            'POST'   => $user->can('create', Photo::class),
            'PUT', 'PATCH' => $user->can('update', $routeModel),
            'DELETE' => $user->can('delete', $routeModel),
            'GET'    => $routeModel
                ? $user->can('view', $routeModel)
                : $user->can('viewAny', Photo::class),
            default => false,
        };
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'image' => [
                $isUpdate ? 'sometimes' : 'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:5120', // 5 MB
            ],
            'commentaire'  => 'nullable|string',
            'retrofit_id'  => ($isUpdate ? 'sometimes' : 'required') . '|exists:retrofits,id',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required'   => 'L’image est requise.',
            'image.image'      => 'Le fichier doit être une image (jpeg, png, etc.).',
            'image.max'        => 'L’image ne peut pas dépasser 5 Mo.',
            'commentaire.string' => 'Le commentaire doit être une chaîne de caractères.',
            'retrofit_id.required' => 'Un retrofit doit être associé à la photo.',
            'retrofit_id.exists'   => 'Le retrofit sélectionné est invalide.',
        ];
    }
}
