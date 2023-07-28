<?php

namespace App\Charts;

use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TrenLulusanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Tren Kelulusan Mahasiswa.')
            ->addLine('Teknik Pertambangan', DaftarSidang::query()->inRandomOrder()->limit(6)->pluck('id')->toArray())
            ->addLine('Teknik Industri', DaftarSidang::query()->inRandomOrder()->limit(6)->pluck('id')->toArray())
            ->addLine('Perencanaan Wilayah dan Kota', DaftarSidang::query()->inRandomOrder()->limit(6)->pluck('id')->toArray())
            ->setColors(['#f5d505', '#026dc4', '#06b8a9'])
            ->setXAxis(['2022/2023', '2023/2024'])
            ->setheight(400);
    }
}
