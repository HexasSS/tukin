<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        // Use pagination instead of get() to enable links() method in the view
        $files = File::with('user', 'juruBayar')->paginate(10);
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
            'uploaded_at' => now(),  // Ensure this is set
            'user_id' => auth()->id(),
            'sat_juru_bayar' => $request->input('sat_juru_bayar'),
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
    }

    // Add this method to your FileController
    public function show($id)
    {
        // Find the file by ID or fail if not found
        $file = File::with('user', 'juruBayar')->findOrFail($id);

        // Return a view to display file details
        return view('files.show', compact('file'));
    }

    public function edit($id)
    {
        // Find the file by ID or fail if not found
        $file = File::findOrFail($id);

        // Return a view to edit the file
        return view('files.edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,xlsx,csv',
            'sat_juru_bayar' => 'required|string|exists:juru_bayars,sat_juru_bayar',
        ]);

        $file = File::findOrFail($id);

        // Delete the old file
        Storage::delete($file->file_path);

        // Store the new file
        $filePath = $request->file('file')->store('uploads');

        // Update file record
        $file->update([
            'file_path' => $filePath,
            'uploaded_at' => now(),  // Ensure this is set
            'sat_juru_bayar' => $request->input('sat_juru_bayar'),
        ]);

        return redirect()->route('files.index')->with('success', 'File updated successfully!');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        // Add a check to ensure the file exists in storage before attempting to download
        if (!Storage::exists($file->file_path)) {
            return redirect()->route('files.index')->withErrors('File not found.');
        }

        return Storage::download($file->file_path);
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Ensure file exists before deleting
        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully!');
    }
}
