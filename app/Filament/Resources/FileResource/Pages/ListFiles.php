<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiles extends ListRecords
{
    protected static string $resource = FileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('template')
                ->label('Unduh Template')
                ->url(asset('storage/000000P1 Template Upload Tunkin.xlsx')) // Use the storage path
                ->color('success'),
            Actions\CreateAction::make(),
        ];
    }
}
