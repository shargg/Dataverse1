<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'dv_users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'is_active',  
    ];

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'dv_users_roles_has_dv_users', 'dv_users_id', 'dv_users_roles_id');
    }

}
