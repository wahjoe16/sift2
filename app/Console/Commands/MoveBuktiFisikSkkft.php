<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MoveBuktiFisikSkkft extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:bukti_fisik_skkft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memindahkan File Bukti Fisik SKKFT';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $files = File::files(public_path('mahasiswa/skkft'));

        foreach ($files as $file) {
            $fileName = $file->getFilename();

            if (!Storage::exists('mahasiswa/skkft/' . $fileName)) {
                Storage::putFileAs('mahasiswa/skkft', $file, $fileName);
                File::delete($file->getPathname());
                $this->info("Moved File: $fileName");
            }
        }

        $data = Kegiatan::whereNotNull('bukti_fisik')->get();

        foreach($data as $d) {
            $oldFile = $d->bukti_fisik;

            if (Str::startsWith($oldFile, 'mahasiswa/skkft')) {
                $d->bukti_fisik = 'mahasiswa/skkft/' . $oldFile;
                $d->save();
                $this->info("Updated bukti fisik kegiatan {$d->id} path.");
            }
        }

        $this->info("Migrasi File Selesai.");
    }
}
