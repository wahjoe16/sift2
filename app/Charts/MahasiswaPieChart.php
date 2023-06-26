<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MahasiswaPieChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $pieMhs = User::where('level', 3)->get();
        $data = [
            $pieMhs->where('program_studi', 'Teknik Pertambangan')->count(),
            $pieMhs->where('program_studi', 'Teknik Industri')->count(),
            $pieMhs->where('program_studi', 'Perencanaan Wilayah dan Kota')->count(),
        ];
        $label = ['Teknik Pertambangan', 'Teknik Industri', 'Perencanaan Wilayah dan Kota'];

        return $this->chart->pieChart()
            ->setTitle('Persentasi Mahasiswa')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors(['#f5d505', '#026dc4', '#06b8a9'])
            ->setLabels($label);
    }
}
