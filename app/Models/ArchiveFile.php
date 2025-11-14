<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_folder_id',
        'name_file',
        'path_file',
        'keterangan',
    ];
}
