<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Crée un identifiant unique par session si inexistant
        if (!session()->has('visitor_id')) {
            session(['visitor_id' => Str::uuid()]);
        }

        $visitorId = session('visitor_id');

        // Vérifie si ce visiteur a déjà été enregistré aujourd'hui
        $alreadyVisited = Visitor::where('visitor_id', $visitorId)
                                ->whereDate('created_at', Carbon::today())
                                ->exists();

        if (!$alreadyVisited) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => url()->current(),
                'visitor_id' => $visitorId
            ]);
        }

        return $next($request);
    }
}
