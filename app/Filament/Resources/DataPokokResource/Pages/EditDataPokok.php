<?php

namespace App\Filament\Resources\DataPokokResource\Pages;

use App\Filament\Resources\DataPokokResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPokok extends EditRecord
{
    protected static string $resource = DataPokokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
