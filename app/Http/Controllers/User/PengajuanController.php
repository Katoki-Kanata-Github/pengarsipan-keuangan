<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('user.pengajuan.pengajuan', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengajuan' => 'required|string',
            'divisi' => 'required|string',
            'file' => 'mimes:pdf|max:20480|nullable',
        ]);

        $iduser = Auth::id();
        $status_kelengkapan = 'Belum Diperiksa';
        $status_verifikasi = 0;

        if (isset($request->file)) {
            $file = $request->file('file');
            $path = $file->storeAs('pengajuan', $file->getClientOriginalName(), 'public');
        } else {
            $path = null;
        }

        $fileName = 'CHECKLIST.xlsx'; // Perbaiki typo: xlxs -> xlsx
        $sourcePath = 'template/' . $fileName;
        $newFileName = $request->nama_pengajuan . '_' . $fileName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        $path_metadata = '';

        // Cek apakah file source ada
        if (Storage::disk('public')->exists($sourcePath)) {

            // Pastikan folder tujuan ada
            $destinationDir = 'metadata_pengajuan';
            if (!Storage::disk('public')->exists($destinationDir)) {
                Storage::disk('public')->makeDirectory($destinationDir);
            }

            // Copy file
            Storage::disk('public')->copy($sourcePath, $destinationPath);
        }

        Pengajuan::create([
            'user_id' => $iduser,
            'pengajuan_name' => $request->nama_pengajuan,
            'path_file_pengajuan' => $path,
            'bagian' => $request->divisi,
            'status_kelengkapan' => $status_kelengkapan,
            'status_verifikasi' => $status_verifikasi,
            'path_file_status_kelengkapan' => $destinationPath,
            'message' => null,
            'status_diarsipkan' => 0,
        ]);

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
