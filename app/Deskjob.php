<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deskjob extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
}
