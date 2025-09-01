<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technologie extends Model
{
    use HasFactory;

    // Propriétés pouvant être assignées massivement
    protected $fillable = ['name', 'type'];

    /**
     * Relation many-to-many avec le modèle Projet.
     */
    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'projet_technologie');
    }
}