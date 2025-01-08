<?php

namespace App\Filament\Resources\PenempatanMagangResource\Widgets;

use App\Models\Penempatan_Magang;
use Filament\Widgets\ChartWidget;

class MagangStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Peserta Magang';

    protected static ?string $maxHeight = '300px';
    

    protected function getOptions(): array
    {
        return [
            'chartArea' => [
                'backgroundColor' => 'transparent',
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                        'drawBorder' => false,
                        'color' => 'rgba(255, 255, 255, 0)',
                    ],
                    'display' => false,
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                        'drawBorder' => false,
                        'color' => 'rgba(255, 255, 255, 0)',
                    ],
                    'display' => false,
                ],
            ],
        ];
    }
    protected function getData(): array
{
    $activeCount = Penempatan_Magang::where('tanggal_selesai', '>=', now())->count();
    $inactiveCount = Penempatan_Magang::where('tanggal_selesai', '<', now())->count();

    return [
        'labels' => ['Aktif', 'Tidak Aktif'], 
        'datasets' => [
            [
                'data' => [$activeCount, $inactiveCount], 
                'backgroundColor' => ['rgb(229, 226, 31)', 'rgb(6, 243, 255)'],
                    'hoverOffset' => 4,
                    'fill' => true,
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
