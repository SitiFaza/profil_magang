<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesertaMagangResource\Pages;
use App\Filament\Resources\PesertaMagangResource\RelationManagers;
use App\Models\PesertaMagang;
use App\Models\Peserta_Magang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesertaMagangResource extends Resource
{
    protected static ?string $model = Peserta_Magang::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Peserta Magang';

    protected static ?string $pluralLabel = 'Peserta Magang';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('id_instansi')
                ->relationship('instansi', 'nama_instansi')
                ->required()
                ->label('Instansi'),

            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255)
                ->label('Nama'),

            Forms\Components\TextInput::make('nomor_induk')
                ->required()
                ->unique()
                ->maxLength(50)
                ->label('Nomor Induk'),

            Forms\Components\Radio::make('jenis_kelamin')
                ->options([
                    'laki laki' => 'Laki-Laki',
                    'perempuan' => 'Perempuan',
                ])
                ->required()
                ->label('Jenis Kelamin'),

            Forms\Components\Textarea::make('alamat')
                ->nullable()
                ->label('Alamat'),

            Forms\Components\TextInput::make('asal_instansi')
                ->required()
                ->maxLength(255)
                ->label('Asal Instansi'),

            Forms\Components\TextInput::make('jurusan')
                ->required()
                ->maxLength(255)
                ->label('Jurusan'),

            Forms\Components\Radio::make('status')
                ->options([
                    'mahasiswa' => 'Mahasiswa',
                    'siswa' => 'Siswa',
                ])
                ->required()
                ->label('Status'),

                Forms\Components\FileUpload::make('berkas')
                ->label('Berkas')
                ->disk('public')
                ->directory('berkas') // Folder penyimpanan
                ->nullable(),
            

        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id_peserta')
                ->label('ID Peserta')
                ->sortable(),

            Tables\Columns\TextColumn::make('instansi.nama_instansi')
                ->label('Instansi')
                ->sortable(),

            Tables\Columns\TextColumn::make('nama')
                ->label('Nama')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('nomor_induk')
                ->label('Nomor Induk')
                ->searchable(),

            Tables\Columns\TextColumn::make('jenis_kelamin')
                ->label('Jenis Kelamin'),

            Tables\Columns\TextColumn::make('asal_instansi')
                ->label('Asal Instansi')
                ->searchable(),

            Tables\Columns\TextColumn::make('jurusan')
                ->label('Jurusan')
                ->searchable(),

            Tables\Columns\TextColumn::make('status')
                ->label('Status'),

            Tables\Columns\ImageColumn::make('berkas_Url')
            ->label('Berkas')
            ->circular()
            ->size(50),
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
            'index' => Pages\ListPesertaMagangs::route('/'),
            'create' => Pages\CreatePesertaMagang::route('/create'),
            'edit' => Pages\EditPesertaMagang::route('/{record}/edit'),
        ];
    }
}
