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

                Tables\Columns\TextColumn::make('pekas')
                    ->label('Pekas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('satker')
                    ->label('Satker')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('anak_satker')
                    ->label('Anak Satker')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kd_satker')
                    ->label('Kode Satker')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('satker')
                    ->label('Filter by Satker')
                    ->options(JuruBayar::pluck('satker', 'satker')->toArray()),

                Tables\Filters\SelectFilter::make('pekas')
                    ->label('Filter by Pekas')
                    ->options(JuruBayar::pluck('pekas', 'pekas')->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Optionally add view action
                Tables\Actions\ViewAction::make(),
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
