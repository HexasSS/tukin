<?php

namespace App\Filament\Resources\JuruBayarResource\Pages;

use App\Filament\Resources\JuruBayarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJuruBayar extends EditRecord
{
    protected static string $resource = JuruBayarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
