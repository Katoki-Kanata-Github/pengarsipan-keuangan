<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentFolder;
use App\Models\DocumentRack;
use Illuminate\Http\Request;

class DocumentRackController extends Controller
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
        return view('admin.archive.form-create-rack');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DocumentRack::create([
            'rack_name' => $request->name,
            'kode_rack' => $request->kode_rack,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.rack.archive')->with('success', 'Berhasil Menambahkan Rak dokumen!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $raks = DocumentRack::where('id', $id)->first();
        $folders = DocumentFolder::where('document_rack_id', $id)->get();
        return view('admin.archive.archive-folder', compact('raks', 'folders'));
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
