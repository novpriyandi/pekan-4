<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_Jawaban extends Model
{
    protected $table = "vote_jawabans";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
