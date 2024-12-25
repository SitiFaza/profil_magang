<?php

namespace App\Filament\Resources\PesertaMagangResource\Pages;

use App\Filament\Resources\PesertaMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPesertaMagang extends EditRecord
{
    protected static string $resource = PesertaMagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
