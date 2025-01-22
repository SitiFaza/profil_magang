<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenempatanMagangResource\Pages;
use App\Filament\Resources\PenempatanMagangResource\RelationManagers;
use App\Models\Penempatan_Magang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenempatanMagangResource extends Resource
{
    protected static ?string $model = Penempatan_Magang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?string $navigationLabel = 'Penempatan Magang';

    protected static ?string $pluralLabel = 'Penempatan Magang';

    protected static ?int $navigationSort = 2; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_bidang')
                    ->relationship('bidang', 'nama_bidang')
                    ->required()
                    ->label('Bidang'),
                
                Forms\Components\Select::make('peserta')
                    ->label('Peserta (Nomor Induk)')
                    ->options(function () {
                        return \App\Models\Peserta_Magang::pluck('nomor_induk', 'id_peserta');
                    })
                    ->multiple() // If selecting multiple participants
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai'),
                
                    Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required()
                    ->label('Tanggal Selesai')
                    ->rules(['after:tanggal_mulai']) // Validasi bawaan Laravel
                    ->reactive() // Aktifkan reaktivitas
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if ($state && $state <= $get('tanggal_mulai')) {
                            $set('tanggal_selesai', null); // Reset tanggal selesai jika salah
                        }
                    }),                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('peserta.nomor_induk')->label('Nomor Induk'),
                Tables\Columns\TextColumn::make('peserta.nama')->label('Peserta'),
                Tables\Columns\TextColumn::make('bidang.nama_bidang')->label('Bidang'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')->label('Tanggal Selesai'),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->formatStateUsing(function ($record) {
                        return now()->isAfter($record->tanggal_selesai) 
                            ? 'Tidak Aktif' 
                            : 'Aktif';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenempatanMagangs::route('/'),
            'create' => Pages\CreatePenempatanMagang::route('/create'),
            'edit' => Pages\EditPenempatanMagang::route('/{record}/edit'),
        ];
    }
}
