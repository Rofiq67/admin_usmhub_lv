<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Aduan;
use App\Models\Aspirasi;

class DashboardChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $aduanCounts = Aduan::selectRaw('jenis_pengaduan, count(*) as count')
            ->groupBy('jenis_pengaduan')
            ->pluck('count', 'jenis_pengaduan')->toArray();

        $aspirasiCounts = Aspirasi::selectRaw('jenis_aspirasi, count(*) as count')
            ->groupBy('jenis_aspirasi')
            ->pluck('count', 'jenis_aspirasi')->toArray();

        $categories = array_keys($aduanCounts + $aspirasiCounts);
        $aduanData = array_values($aduanCounts);
        $aspirasiData = array_values($aspirasiCounts);

        return $this->chart->lineChart()
            ->setTitle('Grafik Aduan dan Aspirasi per Kategori')
            ->setXAxis(['Kebijakan', 'Pelayanan', 'Fasilitas'])
            ->addData('Aduan', $aduanData)
            ->addData('Aspirasi', $aspirasiData)
            ->setColors(['#007bff', '#ffc107']);
    }
}
