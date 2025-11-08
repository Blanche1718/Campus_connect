<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipementRequest extends FormRequest
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
            'nom' => 'required' , 
            'categorie'  => 'string' ,
            'etat'  => 'required',
            'description'  => '' ,
            'disponibilite'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nom.required' =>"Entrez le nom de l'équipement " ,
            'disponibilite.required' =>"La disponibilité est requise"
            ] ;
    }
}
