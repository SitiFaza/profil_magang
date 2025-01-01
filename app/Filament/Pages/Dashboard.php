<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\TotalBidang;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            TotalBidang::class, // Pastikan widget ini sudah ditambahkan
        ];
    }
}
