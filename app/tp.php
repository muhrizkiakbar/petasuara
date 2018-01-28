<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tp extends Model
{
    //
    protected $table="tps";

    public function desa(){
        return $this->belongsTo(desa::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
    

    public function people(){
        return $this->hasMany(people::class);
    }

    
}
