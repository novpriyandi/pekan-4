<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar_Pertanyaan extends Model
{
    protected $table = "komentar_pertanyaans";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
