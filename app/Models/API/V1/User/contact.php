<?php

namespace App\Models\API\V1\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = ['name', 'email', 'message'];
}
