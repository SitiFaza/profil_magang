<?php
namespace App\Filament\Resources\PesertaMagangResource\Widgets;

use App\Models\Peserta_Magang;
use Filament\Widgets\ChartWidget;

class PesertaMagangStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Peserta Magang';

    protected static ?string $maxHeight = '300px';

    // protected static ?string $maxWidth = '400px';

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
        $activeCount = Peserta_Magang::where('status', 'mahasiswa', now())->count();
        $inactiveCount = Peserta_Magang::where('status', 'siswa', now())->count();

        return [
            'labels' => ['Mahasiswa', 'Siswa'],
            'datasets' => [
                [
                    'data' => [$activeCount, $inactiveCount],
                    'backgroundColor' => ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
                    'hoverOffset' => 4,
                    'fill' => true,
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'cutout' => '70%',
                'plugins' => [
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'labels' => [
                            'color' => '#2c3e50',
                        ],
                    ],
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'pie';
    }
    
}