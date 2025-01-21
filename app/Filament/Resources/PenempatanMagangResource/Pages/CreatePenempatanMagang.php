<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta_Magang; // Make sure to import the Peserta_Magang model

class CreatePenempatanMagang extends CreateRecord
{
    protected static string $resource = PenempatanMagangResource::class;
    
    /**
     * Handle record creation with filtering.
     */
    protected function handleRecordCreation(array $data): Model
    {
        if (!isset($data['peserta']) || empty($data['peserta'])) {
            throw new \Exception("Field 'peserta' tidak ditemukan atau kosong.");
        }

        // Filter peserta yang belum memiliki penempatan magang
        $pesertaIds = Peserta_Magang::whereNotIn('id_peserta', function($query) {
            $query->select('id_peserta')
                ->from('penempatan_magang');
        })->whereIn('id_peserta', $data['peserta'])->pluck('id_peserta');

        // If no valid peserta found after filtering
        if ($pesertaIds->isEmpty()) {
            throw new \Exception("Tidak ada peserta yang valid.");
        }

        // Lanjutkan proses jika data 'peserta' ditemukan
        $bidangId = $data['id_bidang'];
        $tanggalMulai = $data['tanggal_mulai'];
        $tanggalSelesai = $data['tanggal_selesai'];

        foreach ($pesertaIds as $pesertaId) {
            $this->getModel()::create([
                'id_peserta' => $pesertaId,
                'id_bidang' => $bidangId,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
            ]);
        }

        return $this->getModel()::firstOrFail();
    }

    /**
     * Redirect after record creation.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
