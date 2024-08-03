<?php

namespace App\Models\API\V1\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'products_table';
    protected $fillable = ['titleGe','titleEn','bodyGe', 'bodyEn', 'titlesEn','titlesGe', 'images'];
    protected $casts = [
        'titlesGe' => 'array',
        'titlesEn' => 'array',
        'images' => 'array',
    ];
}
