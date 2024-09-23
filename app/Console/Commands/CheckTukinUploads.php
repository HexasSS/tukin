<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\File;
use Carbon\Carbon;

class CheckTukinUploads extends Command
{
    protected $signature = 'check:tukin-uploads';

    protected $description = 'Memeriksa apakah admin telah mengunggah tukin untuk bulan ini dan mengirimkan notifikasi email jika belum.';

    public function handle()
    {
        $admins = User::where('role', 'admin')->get();
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');

        foreach ($admins as $admin) {
            $hasUploaded = File::where('user_id', $admin->id)
                ->where('created_at', 'like', "$lastMonth%")
                ->exists();

            if (!$hasUploaded) {
                $this->sendEmailReminder($admin);
            }
        }

        $this->info('Pemeriksaan selesai dan email dikirim jika diperlukan.');
    }

    protected function sendEmailReminder($admin)
    {
        $details = [
            'title' => 'Pengingat: Unggah Tukin Diperlukan',
            'body' => 'Yth. Admin, Anda belum mengunggah tukin untuk bulan ini. Mohon segera mengunggahnya.'
        ];

        Mail::to($admin->email)->send(new \App\Mail\TukinReminder($details));
    }
}
