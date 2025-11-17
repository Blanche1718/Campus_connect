<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersTemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Retourne une collection vide car c'est un modèle
        return collect([]);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Définit les en-têtes des colonnes pour le fichier Excel
        return ['name', 'email'];
    }
}
