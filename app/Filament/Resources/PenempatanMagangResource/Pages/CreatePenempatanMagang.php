<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenempatanMagang extends CreateRecord
{
    protected static string $resource = PenempatanMagangResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
