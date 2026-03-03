<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixNameBanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:name-banner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix name banner';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = Alumni::whereNotNull('banner_img')->get();

        foreach ($data as $d) {
            if (!Str::startsWith($d->banner_img, 'user/banner')) {
                $d->banner_img = 'user/banner/' . $d->banner_img;
                $d->save();
                $this->info("Updated banner path for alumni ID {$d->id}");
            }
        }

        $this->info('Selesai memperbaiki data banner alumni.');
    }
}
