<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function komentars()
    {
        return $this->hasMany('App\Komentar_Jawaban');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote_Jawaban');
    }
}
