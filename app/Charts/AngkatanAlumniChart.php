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
            $pieChart->where('jenis_pekerjaan', 'ASN/BUMN')->count(),
            $pieChart->where('jenis_pekerjaan', 'TNI')->count(),
            $pieChart->where('jenis_pekerjaan', 'POLRI')->count(),
            $pieChart->where('jenis_pekerjaan', 'Swasta')->count(),
            $pieChart->where('jenis_pekerjaan', 'Berwirausaha')->count(),
            $pieChart->where('jenis_pekerjaan', 'Tidak Bekerja')->count(),
        ];

        $label = ['ASN/BUMN', 'TNI', 'POLRI', 'Swasta', 'Berwirausaha', 'Tidak / Belum Bekerja'];


        return $this->chart->pieChart()
            ->setTitle('Jenis Pekerjaan Alumni')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setColors(['#f5d505', '#71eb34', '#026dc4', '#06b8a9', '#f25c11', '#9e9e9e'])
            ->setLabels($label);
    }
}
