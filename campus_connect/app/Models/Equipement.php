<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{

    use HasFactory;

    protected $table = 'equipements';

    protected $fillable = [
        'nom',
        'categorie',
        'etat',
        'description',
        'disponibilite',
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
    ];

}
