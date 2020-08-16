<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_Pertanyaan extends Model
{
    protected $table = "vote_pertanyaans";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
