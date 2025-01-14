<?php

namespace App\Filament\Widgets;

use App\Models\Bidang;
use App\Models\Instansi;
use App\Models\Peserta_Magang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use League\CommonMark\Extension\DescriptionList\Node\Description;
use Filament\Support\Enums\IconPosition;

class DashboardStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Bidang', Bidang::count())
                ->DescriptionIcon('heroicon-o-academic-cap', IconPosition::Before)
                ->description('Jumlah bidang yang terdaftar')
                ->chart([1,3,5,10,20,40])
                ->color('success'), 

            Stat::make('Total Instansi', Instansi::count())
                ->DescriptionIcon('heroicon-o-building-office-2', IconPosition::Before)
                ->description('Jumlah instansi yang terdaftar')
                ->chart([80,20,60,20,60,20,80])
                ->color('warning'), 

            Stat::make('Total Peserta Magang', Peserta_Magang::count())
                ->DescriptionIcon('heroicon-o-user-group', IconPosition::Before)
                ->description('Jumlah peserta magang yang terdaftar')
                ->chart([40,20,17,25,15])
                ->color('danger'), 
        ];
    }
}
