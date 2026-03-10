<?php

namespace App\Console\Commands;

use App\Models\DaftarSidang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MoveSidangFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:move-sidang-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memindahkan file sidang dari folder public ke storage/app/public/sidang';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = DaftarSidang::get();

        foreach ($data as $d) {

            for ($i = 1; $i <= 17; $i++) {

                $field = 'syarat_' . $i;

                if (!empty($d->$field)) {

                    $fileName = basename($d->$field);

                    $oldPath = public_path('mahasiswa/sidang/' . $fileName);
                    $newPath = 'mahasiswa/sidang/' . $fileName;

                    // jika file ada di public
                    if (File::exists($oldPath)) {

                        // pindahkan ke storage
                        Storage::disk('public')->put(
                            $newPath,
                            File::get($oldPath)
                        );

                        // hapus file lama
                        File::delete($oldPath);

                        $this->info("File $fileName berhasil dipindahkan.");
                    }

                    // update path di database jika belum
                    if (!Str::startsWith($d->$field, 'mahasiswa/sidang')) {
                        $d->$field = $newPath;
                    }
                }
            }

            $d->save();
        }
        $this->info("Semua file sidang berhasil diproses.");
    }
}
