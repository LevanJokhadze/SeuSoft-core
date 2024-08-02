<?php

namespace App\Models\API\V1\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterList extends Model
{
    protected $table = 'footer_lists';
    protected $fillable = ['title', 'lists', 'href'];
    protected $casts = [
        'title' => 'string',
        'lists' => 'array',
        'href' => 'string',
    ];
}
