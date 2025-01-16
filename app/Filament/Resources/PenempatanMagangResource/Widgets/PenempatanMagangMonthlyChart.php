<?php

namespace App\Filament\Resources\PenempatanMagangResource\Widgets;

use App\Models\Penempatan_Magang;
use Filament\Widgets\ChartWidget;

class PenempatanMagangMonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penempatan Magang per Bulan';
    
    public int | string | array | null $filterFormData = null;

    // Aktifkan polling untuk memastikan chart selalu up-to-date
    protected static ?string $pollingInterval = null;
    
    // Aktifkan fitur filter
    protected static bool $shouldHandleFilterFormDataUpdates = true;

    public function mount(): void
    {
        $this->filterFormData = now()->year;
    }

    protected function getFilters(): ?array
    {
        $years = Penempatan_Magang::selectRaw('YEAR(tanggal_mulai) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return array_combine($years, $years);
    }

    // Method ini akan dipanggil setiap kali filter berubah
    protected function filterFormUpdated(): void
    {
        $this->updateChartData();
    }

    protected function getData(): array
    {
        $selectedYear = $this->filterFormData;

        $data = Penempatan_Magang::selectRaw('MONTH(tanggal_mulai) as month, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $selectedYear)
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
                    'label' => "Data Tahun $selectedYear",
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