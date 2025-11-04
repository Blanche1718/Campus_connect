<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnonceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre'=> ['required' , 'string'] , 
            'contenu'=>['required'] , 
            'categorie_id' =>'required|exists:categories,id', 
            'auteur_id'=>'nullable|exists:users,id' , // A modifier après
            'date_publication'=>'nullable' ,
            'date_evenement'=>'nullable|after_or_equal:today' , 
            'salle_id'=>'nullable|exists:salles,id' ,
            'equipement_id'=>'nullable|exists:equipements,id ' ,

        ];
    }

    public function messages()
    {
        return [
            'titre.required'=>'Veuillez renseigner ce champ !' ,
            'contenu.required' => "Veuillez renseigner ce champ !" , 
            'categorie_id.required'=> "Vous  devez faire une sélection !" ,
            'categorie_id.exists'=>"Categorie inexistante !" ,
            'date_evenement.after_or_equal'=>"La date d'évenement ne peut être anterieure à la date d'aujourd'hui !" ,
            'salle_id.exists'=>"Salle inexistante !" ,
            'equipement_id.exists'=>"Equipement inexistant !" ,
            ''
            ] ;
    }
}
