<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DosenPieChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $pieDosen = User::where('level', 2)->get();
        $data = [
            $pieDosen->where('program_studi', 'Teknik Pertambangan')->count(),
            $pieDosen->where('program_studi', 'Teknik Industri')->count(),
            $pieDosen->where('program_studi', 'Perencanaan Wilayah dan Kota')->count(),
        ];
        $label = ['Teknik Pertambangan', 'Teknik Industri', 'Perencanaan Wilayah dan Kota'];

        return $this->chart->pieChart()
            ->setTitle('Persentasi Dosen')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors(['#f5d505', '#026dc4', '#06b8a9'])
            ->setLabels($label);
    }
}
