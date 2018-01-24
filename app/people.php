<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class people extends Model
{
    //
    protected $table="peoples";

    public function tp(){
        return $this->belongsTo(tp::class);
    }

    
}
