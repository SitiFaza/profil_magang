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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_bidang')
                ->relationship('bidang', 'nama_bidang')
                ->required()
                ->label('bidang'),
                Forms\Components\Select::make('id_peserta')
                ->relationship('peserta', 'nama')
                ->required()
                ->label('peserta'),
                Forms\Components\DatePicker::make('tanggal_mulai') // Elemen kalender untuk tanggal_mulai
                    ->required()
                    ->label('Tanggal Mulai'),
                Forms\Components\DatePicker::make('tanggal_selesai') // Elemen kalender untuk tanggal_selesai
                    ->required()
                    ->label('Tanggal Selesai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('peserta.nama')->label('Peserta'),
                Tables\Columns\TextColumn::make('bidang.nama_bidang')->label('Bidang'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')->label('Tanggal Selesai'),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan'),
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
