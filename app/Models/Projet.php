<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'objectives',
        'challenges',
        'fonctionnalites',
        'image_path',   
        'imagefirst',
        'link_visualisation', 
        'link_github',
        'status'        
    ];

    public function technologies()
    {
        return $this->belongsToMany(Technologie::class, 'projet_technologie');
    }

    /**
     * Relation one-to-many avec le modèle Image.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}