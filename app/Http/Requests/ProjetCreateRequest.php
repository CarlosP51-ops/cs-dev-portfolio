<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetCreateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true; // Autoriser toutes les soumissions de requête
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectives' => 'nullable|array',
            'objectives.*' => 'string|max:500',
            'challenges' => 'nullable|array',
            'challenges.*' => 'string|max:500',
            'fonctionnalites' => 'nullable|array',
            'fonctionnalites.*' => 'string|max:500',
            'technologies' => 'nullable|array',
            'technologies.*' => 'integer|exists:technologies,id',
            'imagefirst' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_visualisation' => 'nullable|url',
            'link_github' => 'nullable|url',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est requise.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'objectives.string' => 'Les objectifs doivent être une chaîne de caractères.',
            'challenges.string' => 'Les défis doivent être une chaîne de caractères.',
            'fonctionnalites.string' => 'Les fonctionnalités doivent être une chaîne de caractères.',
            'technologies.array' => 'Les technologies doivent être un tableau.',
            'technologies.*.integer' => 'Chaque technologie doit être un identifiant valide.',
            'technologies.*.exists' => 'La technologie sélectionnée est invalide.',
            'imagefirst.image' => 'La première image doit être une image.',
            'imagefirst.mimes' => 'La première image doit être au format jpeg, png, jpg ou gif.',
            'imagefirst.max' => 'La première image ne peut pas dépasser 2 Mo.',
            'link_visualisation.url' => 'Le lien de visualisation doit être une URL valide.',
            'link_github.url' => 'Le lien GitHub doit être une URL valide.',
            'images.array' => 'Les images doivent être un tableau.',
            'images.*.image' => 'Chaque image doit être une image.',
            'images.*.mimes' => 'Chaque image doit être au format jpeg, png, jpg ou gif.',
            'images.*.max' => 'Chaque image ne peut pas dépasser 2 Mo.',
        ];
    }
}
