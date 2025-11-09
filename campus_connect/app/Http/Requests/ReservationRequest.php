<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            "user_id" => 'required|exists:users,id' ,
            'salle_id'  => 'exists:salles,id' ,
            "equipement_id" => 'nullable|exists:equipements,id' ,
            "date_debut"  => 'date|required|after_or_equal:today' ,
            "date_fin"  => 'date|required|after_or_equal:today' ,
            'motif'  => 'nullable' ,
        ];
    }

    public function messages()
    {
        return [
            'salle_id.exists' => "Veuillez sélectionner une salle" ,
            'equipement_id.exists' => "Veuillez sélectionner un equipement" ,
            'date_debut.required' => "Veuillez entrer une date" ,
            'date_fin.required' => "Veuillez entrer une date" ,
            ] ;
    }
}
