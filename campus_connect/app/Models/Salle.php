<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{

    use HasFactory;

    protected $table = 'salles';

    protected $fillable = [
        'nom',
        'capacite',
        'localisation',
        'description',
        'disponibilite',
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
    ];

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'salle_id');
    }
}
