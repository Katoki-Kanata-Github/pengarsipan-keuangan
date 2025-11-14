<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRack extends Model
{
    use HasFactory;

    protected $fillable = [
        'rack_name',
        'kode_rack',
        'keterangan',
    ];
}
