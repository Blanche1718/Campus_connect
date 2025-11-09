<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Salle;
use App\Models\Equipement;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'categorie_id',
        'auteur_id',
        'date_publication',
        'date_evenement',
        'salle_id',
        'equipement_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'equipement_id');
    }
}
