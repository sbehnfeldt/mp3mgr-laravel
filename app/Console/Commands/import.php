<?php

namespace App\Console\Commands;

use App\Importer;
use Exception;
use Illuminate\Console\Command;
use Sbehnfeldt\Mp3lib\ID3TagsReader;

class import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read IDv3 tags for all MP3 files in the configured directory';

    /**
     * Execute the console command.
     */
    public function handle(Importer $importer)
    {
        $importer->import(config('app.mp3Path'));
    }
}
