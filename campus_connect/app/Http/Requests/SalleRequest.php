<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalleRequest extends FormRequest
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
        'nom'  =>'required|string', 
        'capacite' =>'nullable|integer|min:20',
        'localisation' =>'nullable|string' , 
        'description' =>'nullable' , 
        'disponiilite' =>'integer'
        ];
    }

    public function messages()
    {
        return [

            'nom.required'=>"Veuillez entrer un nom pour la salle" ,
            'capacite.integer'=>"Entrée invalide" ,
            'capacite.min'=>"capacite trop petite" ,
            'disponibilite.integer'=>'invalide' ,
            ] ;
    }
}
