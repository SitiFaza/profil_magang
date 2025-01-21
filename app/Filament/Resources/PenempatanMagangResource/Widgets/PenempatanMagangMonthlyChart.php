<?php

namespace App\Filament\Resources\PenempatanMagangResource\Widgets;

use App\Models\Penempatan_Magang;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class PenempatanMagangMonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penempatan Magang per Bulan';
    
    protected function getFilters(): ?array
    {
        $years = Penempatan_Magang::selectRaw('YEAR(tanggal_mulai) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return array_combine($years, $years);
    }

    protected function getData(): array
    {
        $year = $this->filter ?? now()->year;

        $data = Penempatan_Magang::selectRaw('MONTH(tanggal_mulai) as month, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totals = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $totals[$item->month - 1] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => "Data Tahun $year",
                    'data' => $totals,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'fill' => true,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'elements' => [
                'line' => [
                    'tension' => 0.4,
                ],
                'point' => [
                    'radius' => 4,
                    'hoverRadius' => 6,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'enabled' => true,
                    'intersect' => false,
                    'mode' => 'index',
                ],
            ],
        ];
    }
}