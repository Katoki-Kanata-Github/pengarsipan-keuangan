<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pengajuan_name',
        'path_file_pengajuan',
        'bagian',
        'status_kelengkapan',
        'status_verifikasi',
        'path_file_status_kelengkapan',
        'message',
        'status_diarsipkan',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
