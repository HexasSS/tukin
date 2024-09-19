<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\User;
use App\Models\JuruBayar;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,xlsx,csv',
            'sat_juru_bayar' => 'required|string|exists:juru_bayars,sat_juru_bayar',
        ]);

        // Store the file and get its path
        $file = $request->file('file');
        $filePath = $file->store('confidential/uploads', 'local'); // Use a private disk

        // Encrypt the file if needed
        // $encryptedFilePath = $this->encryptFile($filePath);

        // Save file record to the database
        File::create([
            'file_path' => $filePath,
            'uploaded_at' => now(),
            'user_id' => Auth::id(),
            'sat_juru_bayar' => $request->input('sat_juru_bayar'),
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
    }

    public function download(File $file)
    {
        // Ensure the file exists
        if (!Storage::disk('local')->exists($file->file_path)) {
            abort(Response::HTTP_NOT_FOUND, 'File not found.');
        }

        // Download the file
        return Storage::disk('local')->download($file->file_path);
    }

    private function encryptFile($filePath)
    {
        // Implement encryption logic here if necessary
    }
}
