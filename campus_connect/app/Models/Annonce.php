<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Annonce extends Model
{
    protected $fillable = [
        'titre' ,
        'contenu' , 
        'categorie_id' , 
        'auteur_id',
        'date_publication', 
        'date_evenement' ,
        'salle_id',
        'equipement_id'
    ];

    public function auteur () {
        return $this->belongsTo(User::class , 'auteur_id') ;
    }

    public function categorie () {
        return $this->belongsTo(Category::class) ;
    }
}
