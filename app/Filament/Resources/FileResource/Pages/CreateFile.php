<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Jobs\ProcessExcelImport;

class CreateFile extends CreateRecord
{
    protected static string $resource = FileResource::class;

    // Override the create method with the correct signature
    public function create(bool $another = false): void
    {
        // Call parent create method to handle the default creation process
        parent::create($another);

        // Dispatch the job to handle the import process
        $this->dispatchImportJob();
    }

    protected function dispatchImportJob(): void
    {
        // Retrieve the created record
        $record = $this->getRecord();

        // Ensure the file path and user ID are set correctly
        $filePath = $record->file_path; // Adjust if needed
        $userId = $record->user_id; // Adjust if needed

        // Add delay if needed
        $delay = now()->addSeconds(1);

        // Dispatch the job to process the import
        dispatch((new ProcessExcelImport($filePath, $userId))->delay($delay));
    }
}
