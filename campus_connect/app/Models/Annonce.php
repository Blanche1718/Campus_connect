<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory;
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

    public function user () {
        return $this->belongsTo(User::class, 'auteur_id') ;
        }

    public function category () {
        return $this->belongsTo(Category::class) ;
    }
}
