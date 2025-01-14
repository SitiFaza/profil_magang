<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesertaMagangResource\Pages;
use App\Models\Peserta_Magang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesertaMagangResource extends Resource
{
    protected static ?string $model = Peserta_Magang::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Peserta Magang';

    protected static ?string $pluralLabel = 'Peserta Magang';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('berkas_bersama')
                    ->label('Berkas Bersama')
                    ->disk('public')
                    ->directory('berkas')
                    ->visibility('public')
                    ->downloadable()
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadProgressIndicatorPosition('left'),
                
                Forms\Components\Repeater::make('peserta')
                    ->label('Data Peserta Magang')
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
                            ->unique(ignoreRecord: true)
                            ->maxLength(50)
                            ->label('Nomor Induk'),

                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'laki laki' => 'Laki-Laki',
                                'perempuan' => 'Perempuan',
                            ])
                            ->required()
                            ->label('Jenis Kelamin'),

                        Forms\Components\Textarea::make('alamat')
                            ->nullable()
                            ->label('Alamat'),

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

                        Forms\Components\TextInput::make('cp')
                        ->required()
                        ->label('CP'),
                    ])
                    ->columns(2)
                    ->defaultItems(1)
                    ->addActionLabel('Tambah Peserta')
                    ->collapsible()
                    ->reorderableWithButtons()
                    ->cloneable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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

                Tables\Columns\TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),

                Tables\Columns\TextColumn::make('berkas')
                    ->label('Berkas')
                    ->state(function (Peserta_Magang $record): string {
                        return $record->berkas ? 'Lihat Berkas' : 'Tidak ada berkas';
                    })
                    ->url(function (Peserta_Magang $record): ?string {
                        return $record->berkas ? $record->berkasUrl : null;
                    })
                    ->openUrlInNewTab()
                    ->color(fn (Peserta_Magang $record): string => $record->berkas ? 'primary' : 'danger'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesertaMagangs::route('/'),
            'create' => Pages\CreatePesertaMagang::route('/create'),
            'edit' => Pages\EditPesertaMagang::route('/{record}/edit'),
        ];
    }
}