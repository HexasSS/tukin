<?php

namespace App\Filament\Resources\JuruBayarResource\Pages;

use App\Filament\Resources\JuruBayarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJuruBayars extends ListRecords
{
    protected static string $resource = JuruBayarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
