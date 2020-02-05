<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,LaratrustUserTrait,Notifiable;

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

    protected $appends = ['user_status','status_class','role_name'];

    const ACTIVE = 1;
    const BANNED = 0;

    public function userStatus()
    {
        return [
            self::ACTIVE => 'Active',
            self::BANNED => 'Banned',
        ];
    }

    public function getUserStatusAttribute()
    {
        $list = $this->userStatus();
        return $list[$this->status];
    }

    public function userStatusClass()
    {
        return [
            self::ACTIVE => 'badge-success',
            self::BANNED => 'badge-warning',
        ];
    }

    public function getStatusClassAttribute()
    {
        $class = $this->userStatusClass();
        return $class[$this->status];
    }

    public function getRoleNameAttribute()
    {
        $type = "Normal";
        foreach ($this->roles as $role) {
            $type = $role->display_name;
            break;
        }

        return $type;
    }
}
