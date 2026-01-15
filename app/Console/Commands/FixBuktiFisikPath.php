<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixBuktiFisikPath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:bukti_fisik_skkft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix nama file bukti fisik di DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = Kegiatan::whereNotNull('bukti_fisik')->get();

        foreach($data as $d) {
            if (!Str::startsWith($d->bukti_fisik, 'mahasiswa/skkft')) {
                $d->bukti_fisik = 'mahasiswa/skkft/' . $d->bukti_fisik;
                $d->save();
                $this->info("Updated nama bukti fisik {$d->id}");
            }
        }

        $this->info('Selesai memperbaiki path file.');
    }
}
