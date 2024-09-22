<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPokokResource\Pages;
use App\Filament\Resources\DataPokokResource\RelationManagers;
use App\Models\DataPokok;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Exports\DataPokokExporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;

class DataPokokResource extends Resource
{
    protected static ?string $model = DataPokok::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NRP')
                    ->label('NRP/NIP')
                    ->numeric(),
                Forms\Components\TextInput::make('Nama')
                    ->maxLength(255),
                Forms\Components\TextInput::make('Pangkat')
                    ->numeric(),
                Forms\Components\TextInput::make('KelompokDPP')
                    ->numeric(),
                Forms\Components\TextInput::make('AsalMasukan')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('TMTTNI'),
                Forms\Components\TextInput::make('SatJuruBayar')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('TanggalLahir'),
                Forms\Components\TextInput::make('JenisKelamin')
                    ->numeric(),
                Forms\Components\TextInput::make('StatusKawin')
                    ->numeric(),
                Forms\Components\TextInput::make('JumlahAnak')
                    ->numeric(),
                Forms\Components\TextInput::make('JumlahTanggungan')
                    ->numeric(),
                Forms\Components\TextInput::make('StatPenghasilan')
                    ->numeric(),
                Forms\Components\TextInput::make('Korps')
                    ->numeric(),
                Forms\Components\TextInput::make('StatJabatan')
                    ->numeric(),
                Forms\Components\TextInput::make('JenisJabatan')
                    ->label('Jenis Jabatan Struktural')
                    ->numeric(),
                Forms\Components\TextInput::make('EselonJabatan')
                    ->label('Eselon Jabatan Struktural')
                    ->numeric(),
                Forms\Components\TextInput::make('JnsJab2')
                    ->label('Jenis Jabatan Fungsional')
                    ->numeric(),
                Forms\Components\TextInput::make('EseJab2')
                    ->label('Eselon Jabatan Fungsional')
                    ->numeric(),
                Forms\Components\TextInput::make('NamaJabatan')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('TMTJabatan')
                    ->label('TMT Jabatan'),
                Forms\Components\TextInput::make('SewaRumah')
                    ->numeric(),
                Forms\Components\TextInput::make('Pekas')
                    ->maxLength(255),
                Forms\Components\TextInput::make('Gapok')
                    ->label('Gaji Pokok')
                    ->maxLength(255),
                Forms\Components\TextInput::make('TGrade')
                    ->label('Grade Tunjangan')
                    ->numeric(),
                Forms\Components\TextInput::make('KdSatker')
                    ->label('Kode Satker')
                    ->maxLength(255),
                Forms\Components\TextInput::make('KdAnakSatker')
                    ->label('Kode Anak Satker')
                    ->maxLength(255),
                Forms\Components\TextInput::make('MKG')
                    ->label('MKG')
                    ->maxLength(255),
                Forms\Components\TextInput::make('NPWP')
                    ->label('NPWP')
                    ->maxLength(255),
                Forms\Components\TextInput::make('NAMA_REK')
                    ->label('Nama Rekening')
                    ->maxLength(255),
                Forms\Components\TextInput::make('NAMA_BANK')
                    ->label('Nama Bank')
                    ->maxLength(255),
                Forms\Components\TextInput::make('NO_REK')
                    ->label('No. Rek')
                    ->maxLength(255),
                Tables\Columns\TextColumn::make('SANDI')
                    ->label('Sandi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KD_BANK_SPAN')
                    ->label('Kode Bank Span')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TELEPON')
                    ->label('Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TEMPATLHR')
                    ->label('Tempat Lahir')
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(DataPokokExporter::class)
            ])
            ->columns([
                Tables\Columns\TextColumn::make('NRP')
                    ->label('NRP/NIP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Pangkat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('KelompokDPP')
                    ->label('Kelompok DPP')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('AsalMasukan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('SatJuruBayar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TanggalLahir')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('JenisKelamin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('StatusKawin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('JumlahAnak')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('JumlahTanggungan')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('StatPenghasilan')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('Korps')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('StatJabatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('JenisJabatan')
                    ->label('Jenis Jabatan Struktural')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('EselonJabatan')
                    ->label('Jenis Eselon Jabatan Struktural')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('JnsJab2')
                    ->label('Jenis Jabatan Fungsional')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('EseJab2')
                    ->label('Jenis Eselon Jabatan Fungsional')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('NamaJabatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TMTJabatan')
                    ->label('TMT Jabatan')
                    ->dateTime()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('SewaRumah')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('Pekas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('StIrja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Gapok')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TGrade')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('KdSatker')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KdAnakSatker')
                    ->searchable(),
                Tables\Columns\TextColumn::make('MKG')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NPWP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NAMA_REK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NAMA_BANK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NO_REK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SANDI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KD_BANK_SPAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TempatLahir')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDataPokoks::route('/'),
            'create' => Pages\CreateDataPokok::route('/create'),
            'view' => Pages\ViewDataPokok::route('/{record}'),
            'edit' => Pages\EditDataPokok::route('/{record}/edit'),
        ];
    }
}
