<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        "user_id",
        'salle_id' ,
        "equipement_id",
        "date_debut" ,
        "date_fin" ,
        'statut' ,
        'motif'
    ] ;
}
