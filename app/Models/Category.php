<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'categories';

    // Attributs assignables en masse
    protected $fillable = [
        'name',
    ];

    // Relation entre Category et Post (une catégorie a plusieurs posts)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Scope pour filtrer les catégories par nom
    public function scopeByName($query, $name)
    {
        return $query->where('name', $name);
    }
}
