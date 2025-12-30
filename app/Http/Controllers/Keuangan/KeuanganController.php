<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KeuanganController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::all();
        return view('keuangan.dashboard', compact('pengajuans'));
    }

    public function input_arsip()
    {
        return redirect()->route('admin.archive');
    }

    public function check_pengajuan($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        if (Storage::disk('private')->exists($pengajuan->path_file_status_kelengkapan)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_status_kelengkapan);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $namaKegiatan = $worksheet->getCell('B3')->getValue();
        $nokuitansi = $worksheet->getCell('B4')->getValue();
        $kuitansi = trim(preg_replace('/^Nomor\s*:\s*/i', '', $nokuitansi));

        $startCell = 7;
        $endCell = 38;

        $syaratDoc = [];
        while ($startCell <= $endCell) {
            $datasyarat = $worksheet->getCell("C{$startCell}")->getValue();
            $syaratDoc[] = $datasyarat;
            $startCell++;
        }

        // ======== dokumen
        $startCell = 7;
        $ada = [];
        while ($startCell <= $endCell) {
            $dataada = $worksheet->getCell("D{$startCell}")->getValue();
            $ada[] = $dataada;
            $startCell++;
        }
        $startCell = 7;
        $tidakada = [];
        while ($startCell <= $endCell) {
            $datatidakada = $worksheet->getCell("E{$startCell}")->getValue();
            $tidakada[] = $datatidakada;
            $startCell++;
        }
        $startCell = 7;
        $tidakperlu = [];
        while ($startCell <= $endCell) {
            $datatidakperlu = $worksheet->getCell("F{$startCell}")->getValue();
            $tidakperlu[] = $datatidakperlu;
            $startCell++;
        }

        // ========== tanda tangan
        $startCell = 7;
        $lengkap = [];
        while ($startCell <= $endCell) {
            $datalengkap = $worksheet->getCell("G{$startCell}")->getValue();
            $lengkap[] = $datalengkap;
            $startCell++;
        }
        $startCell = 7;
        $belum = [];
        while ($startCell <= $endCell) {
            $databelum = $worksheet->getCell("H{$startCell}")->getValue();
            $belum[] = $databelum;
            $startCell++;
        }

        $startCell = 7;
        $keterangan = [];
        while ($startCell <= $endCell) {
            $dataketerangan = $worksheet->getCell("I{$startCell}")->getValue();
            $keterangan[] = $dataketerangan;
            $startCell++;
        }

        $catatan = $worksheet->getCell('B40')->getValue();

        return view('keuangan.check-pengajuan', compact('pengajuan', 'namaKegiatan', 'kuitansi', 'syaratDoc', 'ada', 'tidakada', 'tidakperlu', 'lengkap', 'belum', 'keterangan', 'catatan'));
    }
}
