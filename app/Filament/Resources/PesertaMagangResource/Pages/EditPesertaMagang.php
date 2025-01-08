<?php

namespace App\Filament\Resources\PesertaMagangResource\Pages;

use App\Filament\Resources\PesertaMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Peserta_Magang;
use Illuminate\Database\Eloquent\Model;

class EditPesertaMagang extends EditRecord
{
    protected static string $resource = PesertaMagangResource::class;

    /**
     * Redirect URL setelah berhasil melakukan update.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Header actions untuk halaman edit.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Mutasi data form sebelum diisi (untuk menampilkan data di form edit).
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil data peserta yang terkait berdasarkan ID record
        $peserta = Peserta_Magang::where('berkas', $this->record->berkas)->get();

        // Transformasikan data peserta menjadi format yang dapat digunakan oleh Repeater
        $data['peserta'] = $peserta->map(function ($item) {
            return [
                'id_instansi' => $item->id_instansi,
                'nama' => $item->nama,
                'nomor_induk' => $item->nomor_induk,
                'jenis_kelamin' => $item->jenis_kelamin,
                'alamat' => $item->alamat,
                'jurusan' => $item->jurusan,
                'status' => $item->status,
            ];
        })->toArray();

        // Tambahkan data berkas lama ke form
        $data['berkas_bersama'] = $this->record->berkas;

        return $data;
    }

    /**
     * Handle update data record.
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Ambil berkas bersama dari data input
        $berkasBersama = $data['berkas_bersama'];

        // Jika pengguna tidak mengunggah berkas baru, gunakan berkas lama
        if (!$berkasBersama) {
            $berkasBersama = $record->berkas;
        }

        // Hapus semua data peserta lama yang terkait dengan berkas ini
        Peserta_Magang::where('berkas', $record->berkas)->delete();

        // Loop data peserta baru dari input dan simpan ke database
        foreach ($data['peserta'] as $pesertaData) {
            $peserta = new Peserta_Magang();
            $peserta->fill([
                ...$pesertaData,
                'berkas' => $berkasBersama, // Gunakan berkas bersama
            ]);
            $peserta->save();
        }

        // Update data utama (record saat ini)
        $record->fill([
            'berkas' => $berkasBersama, // Update berkas jika diperlukan
        ]);
        $record->save();

        return $record; // Kembalikan instance model yang diperbarui
    }
}
