<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenempatanMagang extends EditRecord
{
    protected static string $resource = PenempatanMagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
