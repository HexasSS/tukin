<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProcessExcelImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $filename)
    {
        //
    }

    public function handle(): void
    {
        SimpleExcelReader::create(storage_path('app/' . $this->filename))
            ->getRows()
            ->chunk(500)
            ->each(fn($chunk) => ApplicationsImportChunkJob::dispatch($chunk, $this->filename));
    }
}
