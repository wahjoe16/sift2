<?php

namespace App\Charts;

use App\Models\JobsAlumni;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BidangPekerjaanAlumniChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $pieChart = JobsAlumni::get();
        $data = [
            $pieChart->where('bidang_pekerjaan', 'Pemerintahan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Pendidikan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Industri / Manufaktur')->count(),
            $pieChart->where('bidang_pekerjaan', 'Pertambangan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Konsultan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Hiburan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Ritel')->count(),
            $pieChart->where('bidang_pekerjaan', 'Kesehatan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Keuangan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Lingkungan Hidup')->count(),
            $pieChart->where('bidang_pekerjaan', 'Pertanian')->count(),
            $pieChart->where('bidang_pekerjaan', 'Perikanan')->count(),
            $pieChart->where('bidang_pekerjaan', 'Teknologi Informasi')->count(),
            $pieChart->where('bidang_pekerjaan', 'Lainnya')->count(),

        ];
        $label = [
            'Pemerintahan', 'Pendidikan', 'Industri / Manufaktur', 'Pertambangan', 'Konsultan', 'Hiburan', 
            'Ritel', 'Kesehatan', 'Keuangan', 'Lingkungan Hidup', 'Pertanian', 'Perikanan', 'Teknologi Informasi','Lainnya'
        ];
        
        return $this->chart->pieChart()
            ->setTitle('Bidang Pekerjaan')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors([
                '#026dc4', '#06b8a9', '#065903', '#f5d505', '#004b6b', '#ab5102', '#e80000',
                '#87db42','#09de14','#1bf7f3','#7e1bf7','#8c0088','#e80074','#bdc7c0'
            ])
            ->setLabels($label);
    }
}
