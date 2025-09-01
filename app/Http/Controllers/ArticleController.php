<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCreateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Blog'); // Il serait peut-être utile de passer les articles à la vue ici
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create'); // Vue pour le formulaire de création
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request)
    {
        $path = null;

        if ($request->hasFile('image')) {
            $path = $this->imagePath($request->file('image'));
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->contenue, // Assurez-vous que 'contenue' est bien le bon attribut
            'image_path' => $path,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.'); 
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCreateRequest $request, string $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->contenue;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($article->image_path) {
                $oldImagePath = str_replace('/storage/', '', $article->image_path);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Ajouter la nouvelle image
            $path = $this->imagePath($request->file('image'));
            $article->image_path = $path;
        }

        // Enregistrer les modifications
        $article->save();
        
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        // Vérifier si l'article a une image et la supprimer
        if ($article->image_path) {
            $oldImagePath = str_replace('/storage/', '', $article->image_path);
            Storage::disk('public')->delete($oldImagePath);
        }

        // Supprimer l'article
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }

    private function imagePath($img)
    {
        $originalName = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $img->getClientOriginalExtension();
        $imageName = $originalName . '_' . time() . '.' . $extension;

        $path = $img->storeAs('images', $imageName, 'public');

        return Storage::url($path); // Retourner le chemin complet
    }
}