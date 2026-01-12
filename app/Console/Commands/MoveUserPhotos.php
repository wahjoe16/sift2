<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class MoveUserPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:move-photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pindahkan file foto user dari public ke storage dan update database';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS; 
        $files = File::files(public_path('user/foto'));

        foreach ($files as $file) {
            $filename = $file->getFilename();

            if (!Storage::exists('user/foto/' . $filename)) {
                Storage::putFileAs('user/foto', $file, $filename);
                File::delete($file->getPathname());
                $this->info("Moved file: $filename");
            }
        }

        $users = User::whereNotNull('foto')->get();

        foreach ($users as $user) {
            $oldFoto = $user->foto;

            if (Str::startsWith($oldFoto, 'user/foto/')) {
                // Jika path tetap sama dan cuma pindah folder storage/app/user/foto,
                // biasanya tidak perlu ubah apa-apa, tapi kalau ingin bisa update path
                $user->foto = $oldFoto;
                $user->save();
                $this->info("Updated user {$user->id} foto path.");
            }
        }

        $this->info('Migrasi foto selesai.');
    }
}
