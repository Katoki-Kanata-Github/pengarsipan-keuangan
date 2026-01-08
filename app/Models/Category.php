<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'cabinet_id',
        'category_name',
        'sub_category',
        'year',
        'url_icon',
        'path_icon',
        'description',
    ];
}
