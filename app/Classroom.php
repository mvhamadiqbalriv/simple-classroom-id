<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $table = "classroom";

    public function user(){
        return $this->belongsTo('App\User');
    }
}
