<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JuruBayarResource\Pages;
use App\Filament\Resources\JuruBayarResource\RelationManagers;
use App\Models\JuruBayar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JuruBayarResource extends Resource
{
    protected static ?string $model = JuruBayar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Juru Bayar';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sat_juru_bayar')
                    ->label('Sat Juru Bayar')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nama_sat_juru_bayar')
                    ->label('Nama Sat Juru Bayar')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('pekas')
                    ->label('Pekas')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('satker')
                    ->label('Satker')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('anak_satker')
                    ->label('Anak Satker')
                    ->maxLength(255), // You can make this optional based on your business logic

                Forms\Components\TextInput::make('kd_satker')
                    ->label('Kode Satker')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sat_juru_bayar')
                    ->label('Sat Juru Bayar')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_sat_juru_bayar')
                    ->label('Nama Sat Juru Bayar')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\CheckboxColumn::make('has_uploaded')
                    ->label('Sudah Upload')
                    ->getStateUsing(function (JuruBayar $record) {
                        // Check if the JuruBayar has uploaded a file this month
                        return $record->files()
                            ->whereMonth('uploaded_at', now()->subMonth()->month)  // Last month
                            ->whereYear('uploaded_at', now()->subMonth()->year)    // Ensure it's the correct year as well
                            ->exists();
                    })
                    ->disabled(),
            ])
            ->filters([
                // Optionally add filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListJuruBayars::route('/'),
            'create' => Pages\CreateJuruBayar::route('/create'),
            'edit' => Pages\EditJuruBayar::route('/{record}/edit'),
        ];
    }
}
