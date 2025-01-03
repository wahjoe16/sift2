<?php

namespace App\Charts;

use App\Models\JobsAlumni;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AngkatanAlumniChart
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
            $pieChart->where('profesi_id', 1)->count(),
            $pieChart->where('profesi_id', 2)->count(),
            $pieChart->where('profesi_id', 3)->count(),
            $pieChart->where('profesi_id', 4)->count(),
            $pieChart->where('profesi_id', 5)->count(),
            $pieChart->where('profesi_id', 6)->count(),
            $pieChart->where('profesi_id', 7)->count(),
            $pieChart->where('profesi_id', 8)->count(),
        ];

        $label = ['ASN/BUMN', 'TNI', 'POLRI', 'Dosen', 'Guru' ,'Pegawai Swasta', 'Berwirausaha', 'Ibu Rumah Tangga'];


        return $this->chart->pieChart()
            ->setTitle('Jenis Pekerjaan Alumni')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors([
                '#026dc4', '#06b8a9', '#71eb34', '#f5d505', '#f25c11', '#cc1dba', '#e80000', '#bdc7c0'
            ])
            ->setLabels($label);
    }
}
