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
            $pieChart->where('bidang_pekerjaan', 'Lainnya')->count(),
        ];
        $label = ['Pemerintahan', 'Pendidikan', 'Industri / Manufaktur', 'Pertambangan', 'Konsultan', 'Hiburan', 'Lainnya'];
        
        return $this->chart->pieChart()
            ->setTitle('Bidang Pekerjaan')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors(['#026dc4', '#06b8a9', '#71eb34', '#f5d505', '#f25c11', '#f74400', '#00a8e8'])
            ->setLabels($label);
    }
}
