<?php

namespace App\Filament\Resources\InstansiResource\Widgets;

use App\Models\Instansi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalInstansi extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Instansi', Instansi::count())
            ->description('Jumlah bidang yang tersedia')
            ->color('success'),
        ];
    }
}
