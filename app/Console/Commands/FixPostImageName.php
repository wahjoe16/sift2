<?php

namespace App\Console\Commands;

use App\Models\PostAlumni;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixPostImageName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:post-image-name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix post image names';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = PostAlumni::whereNotNull('media')->get();

        foreach ($data as $d) {
            if (!Str::startsWith($d->media, 'alumni/postingan')) {
                $d->media = 'alumni/postingan/' . $d->media;
                $d->save();
                $this->info("Updated media path for post ID {$d->id}");
            }
        }

        $this->info('Selesai memperbaiki data media postingan alumni.');
    }
}
