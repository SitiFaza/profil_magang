<?php

namespace App\Filament\Resources\PesertaMagangResource\Widgets;

use App\Models\Peserta_Magang;
use Filament\Widgets\ChartWidget;

class PesertaMagangStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Peserta Magang';

    protected function getData(): array
{
    $activeCount = Peserta_Magang::where('status', '>=', now())->count();
    $inactiveCount = Peserta_Magang::where('status', '<', now())->count();

    return [
        'labels' => ['Mahasiswa', 'Siswa'], 
        'datasets' => [
            [
                'data' => [$activeCount, $inactiveCount], 
                'backgroundColor' => ['#4CAF50', '#F44336'], 
                'hoverBackgroundColor' => ['#45d167', '#f55d4e'], 
            ],
        ],
        'options' => [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'layout' => [
                'padding' => 20,
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'r' => [
                    'grid' => [
                        'display' => false, // Hilangkan semua garis grid
                    ],
                    'angleLines' => [
                        'display' => false, // Hilangkan garis sudut
                    ],
                    'ticks' => [
                        'display' => false, // Hilangkan angka koordinat
                        'backdropColor' => 'rgba(0, 0, 0, 0)', // Hilangkan latar belakang angka
                    ],
                ],
            ],
        ],
    ];
}

    protected function getType(): string
    {
        return 'doughnut'; 
    }
}
