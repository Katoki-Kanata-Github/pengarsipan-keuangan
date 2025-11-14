<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function download_file($id)
    {
        $file = ArchiveFile::findOrFail($id);

        $path = storage_path('app/public/' . $file->path_file);

        $originalName = basename($file->path_file);

        return response()->download($path, $originalName);
    }

    public function update_new_file(Request $request, $id)
    {
        $request->validate([
            'file_archive' => 'mimes:pdf|max:20480',
        ]);

        $file = $request->file('file_archive');
        $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

        $archives = ArchiveFile::findOrFail($id);

        $archives->update([
            'path_file' => $path,
        ]);

        return redirect()->route('file.show', ['file' => $id])->with('success', 'Berhasil Upload file');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_with_folder($id)
    {
        $folders = DocumentFolder::where('id', $id)->first();
        return view('admin.archive.form-create-file', compact('folders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->file_archive)) {
            $file = $request->file('file_archive');
            $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');
        } else {
            $path = null;
        }

        $request->validate([
            'name' => 'required|string',
            'file_archive' => 'mimes:pdf|max:20480',
            'keterangan' => 'required|string',
        ]);

        ArchiveFile::create([
            'document_folder_id' => $request->document_folder_id,
            'name_file' => $request->name,
            'path_file' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('folder.show', ['folder' => $request->document_folder_id])->with('success', 'Berhasil Upload file');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $archives = ArchiveFile::where('id', $id)->first();
        $path = $archives->path_file;


        return view('admin.archive.archive-show-file', compact('archives'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
