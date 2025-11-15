<?php


namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Annonce; 
class PublierAnnoncesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $annonceId;

    /**
     * Creation d'une nouvelle instance  de job
     */
    public function __construct(int $annonceId)
    {
        $this->annonceId = $annonceId;
    }

    /**
     * Execution du job job.
     */
    public function handle(): void
    {
        $annonce = Annonce::find($this->annonceId);

        if ($annonce && $annonce->statut === 'planifiee' && $annonce->date_publication <= now()) {
            $annonce->statut = 'publiee';
            $annonce->save();
        }
    }
}
