<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Projet;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


   public function index()
{
    $totalProjects = Projet::count();

    // Visiteurs uniques ce mois
    $totalVisitors = Visitor::whereMonth('created_at', now()->month)
                             ->distinct('visitor_id')
                             ->count('visitor_id');

    // Dernière mise à jour des projets
    $lastUpdate = Projet::latest()->first();
    $lastUpdateDays = $lastUpdate ? now()->diffInDays($lastUpdate->updated_at) : 0;

    // Graphique : visiteurs par mois (uniques)
    $months = [];
    $visitorsPerMonth = [];
    for ($i = 11; $i >= 0; $i--) {
        $month = now()->subMonths($i);
        $months[] = $month->format('M');
        $visitorsPerMonth[] = Visitor::whereMonth('created_at', $month->month)
                                      ->whereYear('created_at', $month->year)
                                      ->distinct('visitor_id')
                                      ->count('visitor_id');
    }

    return view('dashboard', compact(
        'totalProjects',
        'totalVisitors',
        'lastUpdateDays',
        'months',
        'visitorsPerMonth'
    ));
}


    public function showlogin(){
       
        return view('login');
    }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('welcome');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    
    public function updateProfile(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'tel' => 'required|string|unique:users,tel,' . $user->id,
            'photo_de_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'cv_path' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->tel = $request->tel;

        // Gestion de la photo de profil
        if ($request->hasFile('photo_de_profil')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo_de_profil) {
                $oldImagePath = str_replace('/storage/', '', $user->photo_de_profil);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Téléverser la nouvelle photo
            $user->photo_de_profil = $this->imagePath($request->file('photo_de_profil'));
        }

        // Gestion du CV
        if ($request->hasFile('cv_path')) {
            // Supprimer l'ancien CV si nécessaire
            if ($user->cv_path) {
                $oldCvPath = str_replace('/storage/', '', $user->cv_path);
                Storage::disk('public')->delete($oldCvPath);
            }

            // Téléverser le nouveau CV
            $user->cv_path = $this->cvPath($request->file('cv_path'));
        }

        // Enregistrer les modifications
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('user.profile')->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Handle CV file uploads.
     */
    private function cvPath($file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $cvName = $originalName . '_' . time() . '.' . $extension;

        $path = $file->storeAs('cv', $cvName, 'public');
       
        return Storage::url($path); // Retourner le chemin complet
    }

    /**
     * Handle image file uploads.
     */
    private function imagePath($img)
    {
        $originalName = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $img->getClientOriginalExtension();
        $imageName = $originalName . '_' . time() . '.' . $extension;

        $path = $img->storeAs('images', $imageName, 'public');

        return Storage::url($path); // Retourner le chemin complet
    }

   
    public function logout(Request $request)
    {
        // Déconnecter l'utilisateur
        Auth::logout();
        
        // Effacer la session
        $request->session()->invalidate();

        // Régénérer le jeton CSRF
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil ou une autre page
        return redirect()->route('home')->with('success', 'Vous êtes déconnecté avec succès.');
    }
    public function cv() {
    $user = User::find(1);
    
    if (!$user || !$user->cv_path) {
        abort(404); // fichier non trouvé
    }

    // Récupérer le chemin physique du fichier
    $filePath = storage_path('app/public/' . $user->cv_path);

    // Vérifier que le fichier existe réellement
    if (!file_exists($filePath)) {
        abort(404);
    }

    return response()->download($filePath);
}


    public function Profil(){
        $user= User::find(1);
        return view('project.adminProfil',compact('user'));
    }
   public function Projet(Request $request)
{
    $query = Projet::query();

    // Filtrer par recherche
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    // Filtrer par statut
    if ($request->filled('status')) {
        $status = $request->input('status');
        if (in_array($status, ['Terminé', 'En cours', 'En pause'])) {
            $query->where('status', $status);
        }
    }

    // Filtrer par technologie
if ($request->filled('technology')) {
    $techId = $request->input('technology');
    $query->whereHas('technologies', function($q) use ($techId) {
        $q->where('technologies.id', $techId); // <-- ajouter le nom de la table
    });
}


    // Pagination avec conservation des paramètres
    $projects = $query->orderBy('updated_at', 'desc')
                      ->paginate(10)
                      ->withQueryString();

    return view('project.adminProjet', compact('projects'));
}


}