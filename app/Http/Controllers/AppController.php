<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppController extends Controller
{

    public function home()
    {
        $user = User::find(1);

        $projets = Projet::with('technologies')
            ->where('status', 'termine') 
            ->orderByDesc('id')
            ->take(6)
            ->get();

        return view('portfolio', compact('user', 'projets'));
    }


   public function allProject(Request $request)
{
     $user= User::find(1);
    $query = Projet::with('technologies')
                   ->where('status', 'termine'); // seulement projets terminés

    // Recherche texte
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Filtre par technologie
    if ($request->has('technology') && $request->technology != '') {
        $techId = $request->technology;
        $query->whereHas('technologies', function ($q) use ($techId) {
            $q->where('technologies.id', $techId);
        });
    }

    $projets = $query->orderByDesc('id')->paginate(6);

    return view('allProject', compact('projets','user'))
           ->with([
               'search' => $request->search,
               'technology' => $request->technology
           ]);
}

public function send(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'privacy' => 'accepted',
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        // Envoi de l'email
        Mail::send('contact', $data, function($message) use ($data) {
            $message->to('somissicarlos56@gmail.com', 'SOMISSI Mahunan Carlos')
                    ->subject('Nouveau message: ' . $data['subject'])
                    ->replyTo($data['email'], $data['name']);
        });

        return response()->json(['success' => true]);
    }
   

}
