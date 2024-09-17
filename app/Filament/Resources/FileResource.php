<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\JuruBayar;
use App\Models\File;
use App\Jobs\ProcessExcelImport;

class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload File')
                    ->disk('local')
                    ->directory('tunjangan-kinerja')
                    ->required()
                    ->visible(fn() => Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'),

                Forms\Components\Select::make('sat_juru_bayar')
                    ->label('Juru Bayar')
                    ->options(
                        Auth::user()->role === 'admin'
                            ? JuruBayar::where('sat_juru_bayar', Auth::user()->sat_juru_bayar_id)->pluck('nama_sat_juru_bayar', 'sat_juru_bayar')
                            : JuruBayar::all()->pluck('nama_sat_juru_bayar', 'sat_juru_bayar')
                    )
                    ->required()
                    ->default(fn() => Auth::user()->role === 'admin' ? Auth::user()->sat_juru_bayar_id : null),
                // ->disabled(fn() => Auth::user()->role === 'admin'),

                Forms\Components\DateTimePicker::make('uploaded_at')
                    ->label('Uploaded At')
                    ->default(now())
                    ->required()
                    ->readonly(fn() => Auth::user()->role === 'admin'), // readonly instead of disabled
            ]);
    }

    public static function beforeCreate($record): void
    {
        // Ensure the file is associated with the logged-in user
        $record->user_id = Auth::id();

        // Automatically set the sat_juru_bayar_id for admins
        if (Auth::user()->role === 'admin') {
            $record->sat_juru_bayar = Auth::user()->sat_juru_bayar_id;
        }

        if ($record->file_path) {
            // Dispatch the job to process the file
            ProcessExcelImport::dispatch($record->file_path);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_path')->searchable(),
                Tables\Columns\TextColumn::make('uploaded_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Uploaded by')->sortable(),
                Tables\Columns\TextColumn::make('sat_juru_bayar')->label('Juru Bayar')->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }
}
