<?php

use App\Models\Annonce;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    Annonce::where('statut', 'planifiee')
        ->where('date_publication', '<=', Carbon::now())
        ->update([
            'statut' => 'publiee'
        ]);
})->everyMinute();