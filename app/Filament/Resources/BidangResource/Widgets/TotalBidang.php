<?php

namespace App\Filament\Widgets;  // Namespace yang benar

use App\Models\Bidang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalBidang extends BaseWidget
{
    protected ?string $heading = 'Total Bidang';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Bidang', Bidang::count())
                ->description('Jumlah bidang yang tersedia')
                ->color('success'),
        ];
    }
}
