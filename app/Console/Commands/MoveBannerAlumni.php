<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class MoveBannerAlumni extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:move-banner-alumni';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move banner alumni';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $oldPath = public_path('user/banner');
        $newDisk = 'public';
        $newPath = '/user/banner';

        if (!File::exists($oldPath)) {
            $this->error("Directory $oldPath does not exist.");
            return;
        }

        $files = File::files($oldPath);
        foreach ($files as $file) {
            $fileName = $file->getFilename();

            // skip if file already exists in storage
            if (Storage::disk($newDisk)->exists($newPath . '/' . $fileName)) {
                $this->warn("Skip: $fileName already exists in storage.");
                continue;
            }

            // move file to storage
            Storage::disk($newDisk)->putFileAs($newPath, $file, $fileName);

            // delete old file
            File::delete($file->getPathname());
        }

        $this->info('Banner alumni moved successfully.');
    }
}
