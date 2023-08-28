<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'users_id';
    protected $fillable = [
        'name', 'email', 'password', 'foto'
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

    public function ebook()
    {
        return $this->hasMany(Ebook::class, 'users_id', 'users_id');
    }

    public function ejournal()
    {
        return $this->hasMany(EJournal::class, 'users_id','users_id');
    }

    public function pamflet()
    {
        return $this->hasMany(Pamflet::class, 'users_id','users_id');
    }
}
