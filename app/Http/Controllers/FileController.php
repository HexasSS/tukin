<?php

// app/Http/Controllers/FileController.php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        // Paginate the files to allow pagination links in the view
        $files = File::with('user', 'juruBayar')->paginate(10); // Adjust the number per page as needed
        return view('files.index', compact('files'));
    }


    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,xlsx,csv',
            'sat_juru_bayar' => 'required|string|exists:juru_bayars,sat_juru_bayar',
        ]);

        $filePath = $request->file('file')->store('uploads');

        File::create([
            'file_path' => $filePath,
            'uploaded_at' => now(),
            'user_id' => auth()->id(),
            'sat_juru_bayar' => $request->input('sat_juru_bayar'),
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return Storage::download($file->file_path);
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);
        Storage::delete($file->file_path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully!');
    }
}
