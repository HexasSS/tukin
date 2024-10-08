<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use App\Models\JuruBayar;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Berkas';

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

                Forms\Components\DatePicker::make('uploaded_at')
                    ->label('Periode')
                    ->default(now()->subMonth())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_path')->searchable(),
                Tables\Columns\TextColumn::make('uploaded_at')->label('Periode')->dateTime('Y-m')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Uploaded by')->sortable(),
                Tables\Columns\TextColumn::make('juruBayar.nama_sat_juru_bayar')
                    ->label('Nama Juru Bayar')
                    ->searchable(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->role === 'superadmin') {
                    return $query;
                } elseif (auth()->user()->role === 'admin') {
                    return $query->where('sat_juru_bayar', auth()->user()->sat_juru_bayar_id);
                }

                return $query;
            })
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->url(fn(File $record) => route('files.download', $record))
                    ->color('primary'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
