<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DigitalArchive;
use App\Models\Pengajuan;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.pengajuan.pengajuan');
    }

    public function update_check(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if (Storage::disk('private')->exists($pengajuan->path_file_status_kelengkapan)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_status_kelengkapan);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $index = 0;      // mengikuti array dari Blade
        $row   = 7;      // mengikuti baris awal Excel
        $endRow = 38;    // baris akhir Excel

        while ($row <= $endRow) {

            $ada = $request->ada[$index] ?? null;
            $ttd = $request->ttd[$index] ?? null;
            $ket = $request->keterangan[$index] ?? '';

            // D = Ada
            // E = Tidak Ada
            // F = TTD Lengkap
            // G = TTD Belum
            // H = Keterangan

            $worksheet->setCellValue("D{$row}", ($ada == 1) ? 'Y' : '');
            $worksheet->setCellValue("E{$row}", ($ada == 0) ? 'Y' : '');
            $worksheet->setCellValue("F{$row}", ($ada == 2) ? 'Y' : '');

            $worksheet->setCellValue("G{$row}", ($ttd == 1) ? 'Y' : '');
            $worksheet->setCellValue("H{$row}", ($ttd == 0) ? 'Y' : '');

            $worksheet->setCellValue("I{$row}", $ket);

            // NEXT
            $row++;
            $index++;
        }
        $worksheet->setCellValue("B41", $request->catatan);
        $worksheet->getCell('B4')->setValue("Nomor : {$request->kuitansi}");
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        // check kondisi kelengkapan
        $row   = 7;
        $endRow = 38;
        $status_lengkap = false;
        while ($row <= $endRow) {
            $valueADA = $worksheet->getCell("D{$row}")->getValue();
            $valueADAtidakperlu = $worksheet->getCell("F{$row}")->getValue();
            $valueLengkap = $worksheet->getCell("G{$row}")->getValue();

            if ($valueADAtidakperlu === 'Y') {
                $status_lengkap = 'Lengkap';
                $status_verifikasi = true;
            } else {
                if ($valueADA === '' || $valueADA === null) {
                    $status_lengkap = 'Belum Lengkap';
                    $status_verifikasi = false;
                    break;
                }
                if ($valueLengkap === '' || $valueLengkap === null) {
                    $status_lengkap = 'Belum Lengkap';
                    $status_verifikasi = false;
                    break;
                }
            }
            $status_lengkap = 'Lengkap';
            $status_verifikasi = true;

            $row++;
        }

        // === TENTUKAN FILE SOURCE ===
        if (
            $pengajuan->path_file_pengajuan &&
            Storage::disk('private')->exists($pengajuan->path_file_pengajuan) &&
            $status_lengkap == 'Lengkap' &&
            $status_verifikasi
        ) {
            $sourcePath = $pengajuan->path_file_pengajuan;
            // === TAMBAH WATERMARK ===
            $this->addWatermarkToPdf($sourcePath);
        }


        $pengajuan->update([
            'finance_officers_id' => Auth::user()->id,
            'message' => $request->catatan,
            'status_kelengkapan' => $status_lengkap,
            'status_verifikasi' => $status_verifikasi,
            'is_marked' => ($status_lengkap == 'Lengkap' && $status_verifikasi == 1 ? 1 : 0),
            'status_dikembalikan' => ($status_lengkap == 'Lengkap' && $status_verifikasi == 1 ? 0 : 1),
        ]);

        return redirect()->route('keuangan.dashboard')->with('success', 'Berhasil kirim tanggapan');
    }

    private function addWatermarkToPdf(string $filePath)
    {
        if (!Storage::disk('private')->exists($filePath)) {
            Log::error('File PDF tidak ditemukan: ' . $filePath);
            throw new \Exception('File PDF tidak ditemukan');
        }

        $fullPath = Storage::disk('private')->path($filePath);

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/mpdf'),
        ]);

        // === LOAD FILE PDF ASLI ===
        $pageCount = $mpdf->SetSourceFile($fullPath);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $tplId = $mpdf->ImportPage($pageNo);
            $size  = $mpdf->getTemplateSize($tplId);

            $mpdf->AddPageByArray([
                'orientation' => $size['orientation'],
                'width'       => $size['width'],
                'height'      => $size['height'],
            ]);

            $mpdf->UseTemplate($tplId);

            // === GARIS MERAH SOLID DI KIRI (LEBIH TIPIS + OPACITY 50%) ===
            $mpdf->SetAlpha(0.5); // Opacity 50%
            $mpdf->SetDrawColor(255, 0, 0); // Merah
            $mpdf->SetLineWidth(0.5); // Lebih tipis (dari 2 jadi 0.5)
            $mpdf->Line(5, 0, 5, $size['height']);
            $mpdf->SetAlpha(1); // Reset opacity

            // === WATERMARK GAMBAR (60% HALAMAN, CENTER, OPACITY 50%) ===
            $watermarkPath = storage_path('app/public/images/watermark.png');

            if (file_exists($watermarkPath)) {

                [$imgW, $imgH] = getimagesize($watermarkPath);
                $imgRatio = $imgW / $imgH;

                // Target maksimum 60% halaman (dari 80% jadi 60%)
                $maxW = $size['width'] * 0.6;
                $maxH = $size['height'] * 0.6;

                // Hitung ukuran dengan menjaga rasio
                if ($maxW / $maxH > $imgRatio) {
                    // tinggi pembatas
                    $wmHeight = $maxH;
                    $wmWidth  = $wmHeight * $imgRatio;
                } else {
                    // lebar pembatas
                    $wmWidth  = $maxW;
                    $wmHeight = $wmWidth / $imgRatio;
                }

                // Center posisi
                $x = ($size['width']  - $wmWidth)  / 2;
                $y = ($size['height'] - $wmHeight) / 2;

                $mpdf->SetAlpha(0.2); // Opacity 50% (dari 0.2 jadi 0.5)
                $mpdf->Image($watermarkPath, $x, $y, $wmWidth, $wmHeight);
                $mpdf->SetAlpha(1); // Reset opacity
            }
        }

        $mpdf->Output($fullPath, 'F');

        Log::info('Watermark PDF berhasil: ' . $filePath);
    }

    public function perbaikan(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $request->validate([
            'file_pengajuan' => 'mimes:pdf|max:20480|nullable',
        ]);

        if ($request->file_pengajuan) {
            if ($pengajuan->path_file_pengajuan && Storage::disk('private')->exists($pengajuan->path_file_pengajuan)) {
                Storage::disk('private')->delete($pengajuan->path_file_pengajuan);

                $file = $request->file('file_pengajuan');
                $path = $file->storeAs('pengajuan', $file->getClientOriginalName(), 'private');
            }
        } else {
            $path = $pengajuan->path_file_pengajuan;
        }

        // $fileName = 'CHECKLIST.xlsx';
        // $sourcePath = 'template/' . $fileName;
        // // ubah spasi menjadi underscore
        // $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        // $newFileName = $namaPengajuan . '_' . $fileName;
        // $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // if ($pengajuan->path_file_status_kelengkapan && Storage::disk('public')->exists($pengajuan->path_file_status_kelengkapan)) {
        //     Storage::disk('public')->move($pengajuan->path_file_status_kelengkapan, $destinationPath);
        // }

        $pengajuan->update([
            'path_file_pengajuan' => $path,
            'is_marked' => 0,
            'status_dikembalikan' => 0,
            // 'path_file_status_kelengkapan' => $destinationPath,
        ]);

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    public function download_pengajuan($id)
    {
        $file_metadata = Pengajuan::findOrFail($id);

        $path = Storage::disk('private')->path($file_metadata->path_file_pengajuan);

        $fileName = basename($file_metadata->path_file_pengajuan);

        return response()->download($path, $fileName);
    }

    public function lihat_pengajuan($id) // jika sudah diarsipkan
    {
        $file_pengajuan = Pengajuan::findOrFail($id);

        $path = Storage::disk('private')->path($file_pengajuan->path_file_pengajuan);

        // $fileName = basename($file_pengajuan->path_file_pengajuan);

        return response()->file($path);
    }

    public function final_verification(Request $request, $id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        // === TENTUKAN FILE SOURCE ===
        if ($request->hasFile('file_pengajuan')) {

            if (
                $pengajuan->path_file_pengajuan &&
                Storage::disk('private')->exists($pengajuan->path_file_pengajuan)
            ) {
                Storage::disk('private')->delete($pengajuan->path_file_pengajuan);
            }

            $file = $request->file('file_pengajuan');
            $filename = $file->getClientOriginalName();
            $sourcePath = $file->storeAs('pengajuan', $filename, 'private');
        } else {
            $sourcePath = $pengajuan->path_file_pengajuan;
        }

        // === UPDATE DB ===
        $pengajuan->update([
            'revenue_officer_id' => Auth::id(),
            'path_file_pengajuan' => $sourcePath,
            'status_diarsipkan'   => 1,
            'nominal' => $request->biaya,
        ]);

        // add to digital archive
        $tahun = Carbon::now()->year;
        $divisi_pengaju = $pengajuan->user->role;

        $digital_archive = DigitalArchive::where('divisi_name', $divisi_pengaju)->where('year', $tahun)->first();

        if (isset($digital_archive)) {
            $pengajuan->update([
                'digital_archive_id' => $digital_archive->id,
            ]);
        } else {
            $pengajuan_archive =  DigitalArchive::create([
                'divisi_name' => $pengajuan->user->role,
                'year' => $tahun,
            ]);
            $pengajuan->update([
                'digital_archive_id' => $pengajuan_archive->id,
            ]);
        }

        return redirect()
            ->route('bendahara.dashboard')
            ->with('success', 'Berhasil verifikasi final pengajuan');
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
    public function store(Request $request) // revisi tanggal
    {
        $request->validate([
            'nama_pengajuan' => 'required|string',
            'file' => 'mimes:pdf|max:51200|nullable',
        ]);

        $iduser = Auth::id();
        $status_kelengkapan = 'Belum Diperiksa';
        $status_verifikasi = 0;

        // simpan file pdf pengajuan
        if (isset($request->file)) {
            $file = $request->file('file');
            $path = $file->storeAs('pengajuan', $file->getClientOriginalName(), 'private');
        } else {
            $path = null;
        }

        // copy file checklist untuk kelengkapan pengajuan
        $fileName = 'CHECKLIST.xlsx';
        $sourcePath = 'template/' . $fileName;

        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        $newFileName = $namaPengajuan . '_' . $fileName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // Cek apakah file source ada
        if (Storage::disk('private')->exists($sourcePath)) {

            // Pastikan folder tujuan ada
            $destinationDir = 'metadata_pengajuan';
            if (!Storage::disk('private')->exists($destinationDir)) {
                Storage::disk('private')->makeDirectory($destinationDir);
            }

            // Copy file
            Storage::disk('private')->copy($sourcePath, $destinationPath);
        }

        $pengajuan = Pengajuan::create([
            'user_id' => $iduser,
            'pengajuan_name' => $request->nama_pengajuan,
            'assigned_revenue_officer' => $request->assigned_revenue,
            'path_file_pengajuan' => $path,
            'status_kelengkapan' => $status_kelengkapan,
            'status_verifikasi' => $status_verifikasi,
            'path_file_status_kelengkapan' => $destinationPath,
            'status_diarsipkan' => 0,
            'is_marked' => 0,
            'status_dikembalikan' => 0,
            'message' => null,
        ]);

        if (Storage::disk('private')->exists($pengajuan->path_file_status_kelengkapan)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_status_kelengkapan);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setCellValue("B3", 'Nama Kegiatan : ' . $request->nama_pengajuan);
            $writer = new Xlsx($spreadsheet);
            $writer->save($filePathMetadata);
        }

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // oke
    {
        $pengajuan = Pengajuan::with('finance_officer')->findOrFail($id);
        if (Storage::disk('private')->exists($pengajuan->path_file_status_kelengkapan)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_status_kelengkapan);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $namaKegiatan = $worksheet->getCell('B3')->getValue();
        $no = $worksheet->getCell('B4')->getValue();

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

        // ========== tanda tangan
        $startCell = 7;
        $lengkap = [];
        while ($startCell <= $endCell) {
            $datalengkap = $worksheet->getCell("F{$startCell}")->getValue();
            $lengkap[] = $datalengkap;
            $startCell++;
        }
        $startCell = 7;
        $belum = [];
        while ($startCell <= $endCell) {
            $databelum = $worksheet->getCell("G{$startCell}")->getValue();
            $belum[] = $databelum;
            $startCell++;
        }

        $startCell = 7;
        $keterangan = [];
        while ($startCell <= $endCell) {
            $dataketerangan = $worksheet->getCell("H{$startCell}")->getValue();
            $keterangan[] = $dataketerangan;
            $startCell++;
        }

        $catatan = $worksheet->getCell('B40')->getValue();

        return view('user.pengajuan.pengajuan-show', compact('pengajuan', 'namaKegiatan', 'no', 'syaratDoc', 'ada', 'tidakada', 'lengkap', 'belum', 'keterangan', 'catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('user.pengajuan.pengajuan-edit', compact('pengajuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // belum sempurna
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $request->validate([
            'nama_pengajuan' => 'required|string',
            'divisi' => 'required|string',
            'file' => 'mimes:pdf|max:20480|nullable',
        ]);

        if ($request->file) {
            if ($pengajuan->path_file_pengajuan && Storage::disk('public')->exists($pengajuan->path_file_pengajuan)) {
                Storage::disk('public')->delete($pengajuan->path_file_pengajuan);

                $file = $request->file('file');
                $path = $file->storeAs('pengajuan', $file->getClientOriginalName(), 'public');
            }
        } else {
            $path = $pengajuan->path_file_pengajuan;
        }

        $fileName = 'CHECKLIST.xlsx';
        $sourcePath = 'template/' . $fileName;
        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        $newFileName = $namaPengajuan . '_' . $fileName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        if ($pengajuan->path_file_status_kelengkapan && Storage::disk('public')->exists($pengajuan->path_file_status_kelengkapan)) {
            Storage::disk('public')->move($pengajuan->path_file_status_kelengkapan, $destinationPath);
        }

        $pengajuan->update([
            'pengajuan_name' => $request->nama_pengajuan,
            'bagian' => $request->divisi,
            'path_file_pengajuan' => $path,
            'path_file_status_kelengkapan' => $destinationPath,
        ]);

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // oke
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->path_file_pengajuan && Storage::disk('private')->exists($pengajuan->path_file_pengajuan)) {
            Storage::disk('private')->delete($pengajuan->path_file_pengajuan);
        }

        if ($pengajuan->path_file_status_kelengkapan && Storage::disk('private')->exists($pengajuan->path_file_status_kelengkapan)) {
            Storage::disk('private')->delete($pengajuan->path_file_status_kelengkapan);
        }

        $pengajuan->delete();

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }
}
