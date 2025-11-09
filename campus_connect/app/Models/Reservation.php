<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rules\Enum;

/**
 * @property mixed $user_id
 * @property mixed $salle_id
 * @property mixed $equipement_id
 * @property Date $date_debut
 * @property Date $motif
 * @property Enum|string $statut ['en_attente', 'valide', 'rejete']
 */
class Reservation extends Model
{
    //
    protected $fillable = [
        'user_id',
        'salle_id',
        'equipement_id',
        'date_debut',
        'date_fin',
        'motif',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
