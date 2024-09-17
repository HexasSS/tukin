<?php

namespace App\Filament\Resources\DataPokokResource\Pages;

use App\Filament\Resources\DataPokokResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataPokoks extends ListRecords
{
    protected static string $resource = DataPokokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
