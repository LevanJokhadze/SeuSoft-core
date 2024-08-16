<?php

namespace App\Models\API\V1\Admin;

use Illuminate\Database\Eloquent\Model;

class UpdateContact extends Model
{
    protected $table = 'update_contacts';
    protected $fillable = [
        'name', 'addressGe', 'addressEn', 'titleGe', 'titleEn', 'email', 'number', 'fb', 'ig', 'twitter', 'in', 'copyright'
    ];
}
