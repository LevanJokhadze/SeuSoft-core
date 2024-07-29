<?php

namespace App\Models\API\V1\Admin;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Auth extends Authenticatable
{
    use HasApiTokens, Notifiable;
}
