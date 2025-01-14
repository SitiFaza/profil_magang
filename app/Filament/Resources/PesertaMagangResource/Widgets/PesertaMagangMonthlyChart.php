<?php

namespace App\Filament\Resources\PesertaMagangResource\Widgets;

use App\Models\Peserta_Magang;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class PesertaMagangMonthlyChart extends LineChartWidget
{
    protected static ?string $heading = 'Grafik Peserta Magang per Bulan';
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $data = Trend::model(Peserta_Magang::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peserta Magang Tahun ' . now()->year,
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#4F46E5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->map(function (TrendValue $value) use ($months) {
                $monthName = Carbon::parse($value->date)->format('F');
                return $months[$monthName];
            }),
        ];
    }
}