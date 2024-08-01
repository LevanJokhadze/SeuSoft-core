<?php

namespace App\Models\API\V1\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'products_table';
    protected $fillable = ['title', 'body', 'titles', 'images'];
    protected $casts = [
        'titles' => 'array',
        'images' => 'array',
    ];
}
