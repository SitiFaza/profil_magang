<?php

namespace App\Filament\Widgets;

use App\Models\Bidang;
use App\Models\Instansi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Bidang', Bidang::count())
                ->description('Jumlah bidang yang terdaftar')
                ->color('success'), // Hijau untuk bidang

            Stat::make('Total Instansi', Instansi::count())
                ->description('Jumlah instansi yang terdaftar')
                ->color('danger'), // Merah untuk instansi

            Stat::make('Total Peserta Magang', Instansi::count())
                ->description('Jumlah peserta magang yang terdaftar')
                ->color('danger'), // Merah untuk instansi
        ];
    }
}
