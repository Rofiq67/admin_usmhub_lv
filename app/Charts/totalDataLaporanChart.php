<?php

namespace App\Charts;

use App\Models\Aduan;
use App\Models\Aspirasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class totalDataLaporanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $dataAduan = Aduan::count();
        $dataAspirasi = Aspirasi::count();
        $label = [
            'Pengaduan', 'Aspirasi'
        ];

        return $this->chart->pieChart()
            ->setTitle('Data laporan')
            ->addData([$dataAduan, $dataAspirasi]) // Pass counts as an array
            ->setLabels($label);
    }
}
