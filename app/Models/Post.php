<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis via le formulaire.
     *
     * @var array
     */
    protected $fillable = [
        'title',   // Titre du post
        'content', // Contenu du post
        'status',  // Statut (brouillon ou publié)
        'category_id',
        'user_id',
    ];

    /**
     * Les valeurs par défaut pour certains attributs.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'brouillon',
    ];

    /**
     * Indique si le modèle utilise les timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Vérifie si le post est publié.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->status === 'publié';
    }

    public function publish()
{
    $this->status = 'publié';
    $this->save();
}


    // app/Models/Post.php
public function category()
{
    return $this->belongsTo(Category::class);
}
public function user()
    {
        return $this->belongsTo(User::class);
    }

}
