<?php

namespace App\Console\Commands;

use App\Models\DaftarSeminar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MoveSeminarFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:move-files-seminar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memindahkan file seminar dari folder public ke storage/app/public/seminar';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = DaftarSeminar::get();

        foreach ($data as $d) {

            for ($i = 1; $i <= 14; $i++) {

                $field = 'syarat_' . $i;

                if (!empty($d->$field)) {

                    $fileName = basename($d->$field);

                    $oldPath = public_path('mahasiswa/seminar/' . $fileName);
                    $newPath = 'mahasiswa/seminar/' . $fileName;

                    // jika file ada di public
                    if (File::exists($oldPath)) {

                        // pindahkan ke storage
                        Storage::disk('public')->put(
                            $newPath,
                            File::get($oldPath)
                        );

                        // hapus file lama
                        File::delete($oldPath);

                        $this->info("Moved: {$fileName}");
                    }

                    // update path di database jika belum
                    if (!Str::startsWith($d->$field, 'mahasiswa/seminar')) {
                        $d->$field = $newPath;
                    }
                }
            }

            $d->save();
        }

        $this->info('Selesai memindahkan file seminar.');
    }
}
