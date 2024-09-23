<?php

namespace App\Filament\Widgets;

use App\Models\JuruBayar;
use App\Models\File;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JuruBayarUploadStatus extends Widget
{
    protected static string $view = 'filament.widgets.juru-bayar-upload-status';

    public $totalJuruBayar;
    public $juruBayarUploaded;

    public function mount()
    {
        $this->totalJuruBayar = JuruBayar::count();

        $lastMonth = Carbon::now()->subMonth()->month;

        $this->juruBayarUploaded = JuruBayar::whereHas('files', function ($query) use ($lastMonth) {
            $query->whereMonth('uploaded_at', $lastMonth);
        })->count();
    }
}
