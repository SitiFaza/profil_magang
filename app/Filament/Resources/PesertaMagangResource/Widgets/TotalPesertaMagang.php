<?php

namespace App\Filament\Resources\PesertaMagangResource\Widgets;

use App\Models\Peserta_Magang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPesertaMagang extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Peserta Magang', Peserta_Magang::count())
            ->description('Jumlah Peserta Magang yang terdaftar')
            ->color('success'),
        ];
    }
}
