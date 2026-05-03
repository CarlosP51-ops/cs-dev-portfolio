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

    protected $casts = [
        'objectives'      => 'array',
        'challenges'      => 'array',
        'fonctionnalites' => 'array',
    ];

    // Accesseurs — retourne toujours un array propre
    public function getObjectivesAttribute($value): array
    {
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return $decoded;
        // Cas legacy : string encodée deux fois
        $decoded2 = json_decode($decoded, true);
        return is_array($decoded2) ? $decoded2 : [];
    }

    public function getChallengesAttribute($value): array
    {
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return $decoded;
        $decoded2 = json_decode($decoded, true);
        return is_array($decoded2) ? $decoded2 : [];
    }

    public function getFonctionnalitesAttribute($value): array
    {
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return $decoded;
        $decoded2 = json_decode($decoded, true);
        return is_array($decoded2) ? $decoded2 : [];
    }

    // Mutateurs — stocke toujours du JSON propre
    public function setObjectivesAttribute($value): void
    {
        $this->attributes['objectives'] = json_encode(is_array($value) ? array_values(array_filter($value)) : []);
    }

    public function setChallengesAttribute($value): void
    {
        $this->attributes['challenges'] = json_encode(is_array($value) ? array_values(array_filter($value)) : []);
    }

    public function setFonctionnalitesAttribute($value): void
    {
        $this->attributes['fonctionnalites'] = json_encode(is_array($value) ? array_values(array_filter($value)) : []);
    }

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