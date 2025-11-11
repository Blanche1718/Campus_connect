<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Salle;
use App\Models\Equipement;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model

{
    use HasFactory;
    protected $fillable = [
        "user_id" ,
        'salle_id' ,
        "equipement_id",
        "date_debut" ,
        "date_fin" ,
        'statut' ,
        'motif'
    ] ;

    public function user () {
        return $this->belongsTo(User::class , );
    }
    
    public function salle () {
        return $this->belongsTo(Salle::class);
    }

    public function equipement () {
        return $this->belongsTo(Equipement::class);
    }

    
}
