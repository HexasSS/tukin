<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use App\Http\Controllers;
use App\Http\Controllers\DataPokokImportController;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateFile extends CreateRecord
{
    protected static string $resource = FileResource::class;

    protected function handleRecordCreation(array $data): \App\Models\File
    {
        // Create the record first
        $file = parent::handleRecordCreation($data);

        // Process the uploaded file
        if (!empty($data['file_path'])) {
            $filePath = $data['file_path'];

            // Ensure the file is stored correctly
            $fullPath = Storage::disk('local')->path($filePath);

            // Dispatch the job to process the file
            $controller = new DataPokokImportController();
            $controller->importFile($fullPath);
        }

        return $file;
    }
}
