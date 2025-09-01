<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjetCreateRequest;
use App\Models\Projet;
use App\Models\User;
use App\Models\Technologie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    
    public function index()
    {
        return view('projetShow');
    }

    public function create()
    {
        $tech = Technologie::all();
        return view('project.create',compact('tech'));

    }

        public function store(ProjetCreateRequest $request)
    {
          $validatedData = $request->validated();
         
        // Création du projet
        $projet = Projet::create([
            'title' => $request->title,
            'description' => $request->description,
            'objectives' => $request->objectives,
            'challenges' => $request->challenges,
            'fonctionnalites' => $request->fonctionnalites,
            'imagefirst' => $this->imagePath($request->file('imagefirst')),
            'link_visualisation' => $request->link_visualisation,
            'link_github' => $request->link_github,
            'status'=>$request->status,
        ]);

        
        if ($request->filled('technologies')) {
            $projet->technologies()->attach($request->technologies);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $projet->images()->create(['image_path' => $this->imagePath($image)]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function show(string $id)
    {   
        $user =  User::find(1);
            $projet = Projet::with('images', 'technologies')
        ->where('id', $id)
        ->where('status', 'termine')
        ->firstOrFail();   
       
         return view('project.Pro', compact('projet','user'));

    }

   
   public function edit(string $id)
{
    // Récupérer le projet par son identifiant avec ses technologies et images
    $project = Projet::with(['technologies', 'images'])->findOrFail($id);

    // Récupérer toutes les technologies disponibles
    $allTechnologies = Technologie::all();

    // Passer le projet et les technologies à la vue
    return view('project.eedit', compact('project', 'allTechnologies'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjetCreateRequest $request, string $id)
{
    $project = Projet::findOrFail($id);

    // Mettre à jour les informations du projet
        $project->update($request->only([
        'title',
        'description',
        'objectives',
        'challenges',
        'fonctionnalites',
        'link_visualisation',
        'link_github',
        'status',
    ]));


    if ($request->hasFile('imagefirst')) {
        if ($project->imagefirst) {
            $oldImagePath = str_replace('/storage/', '', $project->imagefirst);
            Storage::disk('public')->delete($oldImagePath);
        }
        $project->imagefirst = $this->imagePath($request->file('imagefirst'));
    }

    // Attacher les technologies sélectionnées
    if ($request->filled('technologies')) {
        $project->technologies()->sync($request->technologies); // Synchroniser les technologies
    } else {
        $project->technologies()->detach(); // Détacher les technologies si aucun n'est sélectionné
    }

    // Enregistrer les modifications
    $project->save();

    //return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $project = Projet::findOrFail($id);

    // Supprimer l'image principale
    if ($project->imagefirst) {
        $oldImagePath = str_replace('/storage/', '', $project->imagefirst);
        Storage::disk('public')->delete($oldImagePath);
    }

    // Supprimer les images associées
    foreach ($project->images as $image) {
        Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_path));
        $image->delete();
    }

    // Détacher toutes les technologies associées
    $project->technologies()->detach();

    // Supprimer le projet
    $project->delete();

    return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
}

    private function imagePath($img)
    {
        $originalName = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $img->getClientOriginalExtension();
        $imageName = $originalName . '_' . time() . '.' . $extension;
        $path = $img->storeAs('images', $imageName, 'public');
        return Storage::url($path);
    }
}