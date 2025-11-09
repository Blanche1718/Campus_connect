<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'categorie_id');
    }
}

