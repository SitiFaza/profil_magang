<?php

namespace App\Filament\Resources\PenempatanMagangResource\Pages;

use App\Filament\Resources\PenempatanMagangResource;
use App\Models\Bidang;
use App\Models\Penempatan_Magang;
use App\Models\Peserta_Magang;
use Filament\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPenempatanMagang extends EditRecord
{
    protected static string $resource = PenempatanMagangResource::class;

    /**
     * Redirect to index page after save.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Header actions including delete action.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Mutate form data before filling the edit form.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Temukan data peserta berdasarkan id_peserta
        $peserta = Peserta_Magang::find($data['id_peserta']);

        if ($peserta) {
            $data['nomor_induk'] = $peserta->nomor_induk; // Isi nomor_induk dari relasi peserta
        }

        // Pastikan nomor_induk ada sebelum mengembalikan data
        if (!isset($data['nomor_induk'])) {
            $data['nomor_induk'] = null; // Atau beri nilai default
        }

        return $data;
    }

    /**
     * Handle record update with nomor_induk mapping back to id_peserta.
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Cari peserta berdasarkan nomor_induk
        $peserta = Peserta_Magang::where('id_peserta', $data['id_peserta'])->first();

        if (!$peserta) {
            throw new \Exception('Peserta dengan nomor induk ini tidak ditemukan.');
        }

        // Update data penempatan magang
        $record->update([
            'id_peserta' => $peserta->id_peserta,
            'id_bidang' => $data['id_bidang'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
        ]);

        return $record;
    }

    /**
     * Form schema for edit page.
     */
    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_induk')
                    ->label('Nomor Induk')
                    ->disabled(),
                
                // Ganti TextInput::relationship dengan Select
                Select::make('id_bidang')
                    ->relationship('bidang', 'nama_bidang')
                    ->label('Nama Bidang'),
                
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),
                
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),

                Forms\Components\Hidden::make('id_peserta'), 
                Forms\Components\Hidden::make('id_bidang'),  
            ]);
    }
}
