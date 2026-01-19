<?php

namespace App\Console\Commands;

use App\Models\Archive;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixFileArchives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:file-archives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaiki data file arsip jika ada yang bermasalah';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = Archive::whereNotNull('file')->get();
        
        foreach ($data as $d) {
            if (!Str::startsWith($d->file, 'file/archives')) {
                $d->file = 'file/archives/' . $d->file;
                $d->save();
                $this->info("Updated file path for archive ID {$d->id}");
            }
        }

        $this->info('Selesai memperbaiki data file arsip.');
    }
}
