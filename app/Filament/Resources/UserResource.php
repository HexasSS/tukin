<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengguna';
    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'superadmin'; // Only allow 'admin' role to view this resource
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state)) // Hash the password before storing it
                    ->dehydrated(fn($state) => filled($state)), // Only store password if it's set (for updates),

                Forms\Components\Select::make('sat_juru_bayar_id')
                    ->label('Sat Juru Bayar')
                    ->relationship('juruBayar', 'nama_sat_juru_bayar') // Assuming you have a relationship defined in your model
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'superadmin' => 'Superadmin',
                        'admin' => 'Admin',
                    ])
                    ->required()
                    ->default('admin'), // Default role is 'admin'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('juruBayar.nama_sat_juru_bayar')
                    ->label('Sat Juru Bayar')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('role')
                    ->label('Role')
                    ->colors([
                        'primary' => 'superadmin',
                        'success' => 'admin',
                    ])
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sat_juru_bayar_id')
                    ->label('Sat Juru Bayar')
                    ->relationship('juruBayar', 'nama_sat_juru_bayar')
                    ->searchable(),

                Tables\Filters\SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        'superadmin' => 'Superadmin',
                        'admin' => 'Admin',
                    ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
