<?php

namespace App\Filament\Resources\PesertaMagangResource\Pages;

use App\Filament\Resources\PesertaMagangResource;
use App\Models\Peserta_Magang;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditPesertaMagang extends EditRecord
{
    protected static string $resource = PesertaMagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Transform single record data into the format expected by the Repeater
        $data['peserta'] = [[
            'id_instansi' => $this->record->id_instansi,
            'nama' => $this->record->nama,
            'nomor_induk' => $this->record->nomor_induk,
            'jenis_kelamin' => $this->record->jenis_kelamin,
            'alamat' => $this->record->alamat,
            'jurusan' => $this->record->jurusan,
            'status' => $this->record->status,
            'cp' => $this->record->cp,
        ]];

        // Set existing file path
        $data['berkas_bersama'] = $this->record->berkas;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Get berkas_bersama from input or keep existing one
        $berkasBersama = $data['berkas_bersama'] ?? $record->berkas;

        // Only handle file deletion if a new file is uploaded
        if (isset($data['berkas_bersama']) && $data['berkas_bersama'] !== $record->berkas) {
            // Delete old file if exists and different from new one
            if ($record->berkas && Storage::disk('public')->exists($record->berkas)) {
                Storage::disk('public')->delete($record->berkas);
            }
        }

        // Update peserta data
        $pesertaData = $data['peserta'][0] ?? [];
        
        $record->fill([
            ...$pesertaData,
            'berkas' => $berkasBersama,
        ]);
        
        $record->save();

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}