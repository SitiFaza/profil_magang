<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resources\BidangResource\Widgets\TotalBidang; // Pastikan namespace benar

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            TotalBidang::class,
        ];
    }
}
