<?php

namespace App\Filament\Resources\PenempatanmagangResource\Widgets;

use Filament\Widgets\ChartWidget;

class PenempatanMagangMonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
