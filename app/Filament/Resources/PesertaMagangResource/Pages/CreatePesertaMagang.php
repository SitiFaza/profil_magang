<?php

namespace App\Filament\Resources\PesertaMagangResource\Pages;

use App\Filament\Resources\PesertaMagangResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePesertaMagang extends CreateRecord
{
    protected static string $resource = PesertaMagangResource::class;

    // Override redirect URL after successful creation
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

    // Override method create untuk menangani multiple peserta
    protected function handleRecordCreation(array $data): Model
    {
        // Ambil berkas bersama
        $berkasBersama = $data['berkas_bersama'];
        
        // Ambil data peserta pertama untuk dijadikan return value
        $firstPeserta = null;
        
        // Loop through semua data peserta
        foreach ($data['peserta'] as $pesertaData) {
            $peserta = new ($this->getModel())();
            
            // Set data peserta
            $peserta->fill([
                ...$pesertaData,
                'berkas' => $berkasBersama, // Gunakan berkas bersama
            ]);
            
            $peserta->save();
            
            // Simpan peserta pertama untuk return value
            if (!$firstPeserta) {
                $firstPeserta = $peserta;
            }
        }
        
        return $firstPeserta;
    }
}