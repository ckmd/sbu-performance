<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $value) {
                if ($this->checkUserRole($value)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getUserRole()
    {
        return $this->role->nama;
    }

    public function checkUserRole($role)
    {
        return $role == $this->getUserRole() ? true : false;
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function sbu()
    {
        return $this->belongsTo('App\Sbu', 'sbu_id');
    }

    public function sbu()
    {
        return $this->belongsTo('App\JenisAkun', 'jenis_akun_id');
    }
}