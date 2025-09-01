<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Afficher la page profil.
     */
    public function show()
    {
        // Récupère l'utilisateur connecté
        $user = User::findOrFail(1); 
        return view('project.adminProfil', compact('user'));
    }

    /**
     * Mettre à jour le profil de l'utilisateur.
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validation de tous les champs
    $request->validate([
        'name'          => 'required|string|max:255',
        'surname'       => 'required|string|max:255',
        'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
        'tel'           => 'nullable|string|max:20',
        'service'       => 'nullable|string|max:255',
        'facebook_link' => 'nullable|url|max:255',
        'github_link'   => 'nullable|url|max:255',
        'linkedin_link' => 'nullable|url|max:255',

        'photo_de_profil' => 'nullable|image|max:2048', // 2MB max
        'cv_path'         => 'nullable|mimes:pdf,doc,docx|max:5120', // 5MB max
    ]);

    // Récupérer toutes les données sauf les fichiers
    $data = $request->except(['photo_de_profil', 'cv_path']);

    // Upload photo de profil
    if ($request->hasFile('photo_de_profil')) {
        if ($user->photo_de_profil) {
            Storage::disk('public')->delete($user->photo_de_profil);
        }
        $data['photo_de_profil'] = $request->file('photo_de_profil')->store('photos_profil', 'public');
    }

    // Upload CV
    if ($request->hasFile('cv_path')) {
        if ($user->cv_path) {
            Storage::disk('public')->delete($user->cv_path);
        }
        $data['cv_path'] = $request->file('cv_path')->store('cvs', 'public');
    }

    // Mise à jour
    $user->update($data);

    return redirect()->back()->with('success', 'Profil mis à jour avec succès ✅');
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('project.updateProfil', compact('user'));
    }
}
