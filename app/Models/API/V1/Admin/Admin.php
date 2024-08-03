<?php

namespace App\Models\API\V1\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'products_table';
    protected $fillable = ['titleGe','titleEn','bodyGe', 'bodyEn', 'titlesEn','titlesGe', 'href', 'images'];
    protected $casts = [
        'titlesGe' => 'array',
        'titlesEn' => 'array',
        'href' => 'array',
        'images' => 'array',
    ];
}
