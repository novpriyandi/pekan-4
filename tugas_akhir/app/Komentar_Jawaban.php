<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar_Jawaban extends Model
{
    protected $table = "komentar_jawabans";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
