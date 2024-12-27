<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenempatanMagangs extends ListRecords
{
    protected static string $resource = PenempatanMagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
