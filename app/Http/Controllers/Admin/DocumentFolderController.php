<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\DocumentFolder;
use App\Models\DocumentRack;
use Illuminate\Http\Request;

class DocumentFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.archive.archive-create-folder'); // tidak dipakai
    }

    public function create_wit_rack(string $id)
    {
        $raks = DocumentRack::where('id', $id)->first();
        return view('admin.archive.form-create-folder', compact('raks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DocumentFolder::create([
            'document_rack_id' => $request->document_rack_id,
            'folder_name' => $request->name,
            'kode_folder' => $request->kode_folder,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('rak.show', ['rak' => $request->document_rack_id])->with('success', 'berhasil menambahkan folder!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folders = DocumentFolder::where('id', $id)->first();
        $files = ArchiveFile::where('document_folder_id', $id)->get();
        return view('admin.archive.archive-file', compact('folders', 'files'));
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
