<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deskjob_user extends Model
{
    public function deskjob(){
        return $this->belongsTo('\App\Deskjob');
    }
}
