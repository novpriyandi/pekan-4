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

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function pertanyaans()
    {
        return $this->hasMany('App\Pertanyaan');
    }

    public function jawabans()
    {
        return $this->hasMany('App\Jabawan');
    }

    public function komentar_pertanyaans()
    {
        return $this->hasMany('App\Komentar_Pertanyaan');
    }

    public function komentar_jawabans()
    {
        return $this->hasMany('App\Komentar_Jawabans');
    }

    public function vote_pertanyaans()
    {
        return $this->hasMany('App\Vote_Pertanyaan');
    }

    public function vote_jawabans()
    {
        return $this->hasMany('App\Vote_Jawabans');
    }

}
