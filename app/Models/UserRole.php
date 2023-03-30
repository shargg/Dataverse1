<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'dv_users_roles_has_dv_users';

    public $timestamps = false;

    protected $fillable = [
        'dv_users_roles_id',
        'dv_users_id',
    ];
}
