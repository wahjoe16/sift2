<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class FixUserPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:user-foto-path';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaiki path foto user agar sesuai folder user/foto/';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $users = User::whereNotNull('foto')->get();

        foreach ($users as $user) {
            if (!Str::startsWith($user->foto, 'user/foto/')) {
                $user->foto = 'user/foto/' . $user->foto;
                $user->save();
                $this->info("Updated user ID {$user->id}");
            }
        }

        $this->info('Selesai memperbaiki path foto.');
    }
}
