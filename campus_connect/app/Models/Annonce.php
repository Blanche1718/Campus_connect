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
        'statut',
        'categorie_id',
        'auteur_id',
        'date_publication',
        'date_evenement',
        'salle_id',
        'equipements',
    ];
    protected $casts = [
        'equipements' => 'array',
        'date_publication' => 'datetime',
        'date_evenement' => 'datetime',
    ];

    
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

    /**
     * Récupère les modèles Equipement basés sur les IDs stockés dans la colonne JSON.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEquipementsDetailsAttribute()
    {
        // Assurez-vous que $this->equipements est un tableau, même si le casting devrait le faire.
        $equipementIds = $this->equipements;
        if (is_string($equipementIds)) {
            $equipementIds = json_decode($equipementIds, true);
        }
        return Equipement::whereIn('id', $equipementIds ?? [])->get();
    }
}
