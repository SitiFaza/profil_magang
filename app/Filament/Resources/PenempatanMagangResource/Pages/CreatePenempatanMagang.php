<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta_Magang;
use Filament\Notifications\Notification;

class CreatePenempatanMagang extends CreateRecord
{
    protected static string $resource = PenempatanMagangResource::class;

    /**
     * Handle record creation with validation and notification.
     */
    protected function handleRecordCreation(array $data): Model
    {
        try {
            // Validasi tanggal
            if ($data['tanggal_mulai'] > $data['tanggal_selesai']) {
                throw new \Exception("Tanggal selesai harus setelah tanggal mulai.");
            }

            // Filter peserta
            $pesertaIds = Peserta_Magang::whereNotIn('id_peserta', function ($query) {
                $query->select('id_peserta')->from('penempatan_magang');
            })->whereIn('id_peserta', $data['peserta'])->pluck('id_peserta');

            if ($pesertaIds->isEmpty()) {
                throw new \Exception("Tidak ada peserta yang valid.");
            }

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

            // Notifikasi sukses
            Notification::make()
                ->title('Berhasil')
                ->success()
                ->body('Data berhasil ditambahkan!')
                ->send();

            return $this->getModel()::firstOrFail();
        } catch (\Exception $e) {
            // Notifikasi error
            Notification::make()
                ->title('Gagal')
                ->danger()
                ->body($e->getMessage())
                ->send();

            // Tetap lempar error untuk rollback jika diperlukan
            throw $e;
        }
    }

    /**
     * Redirect after record creation.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
