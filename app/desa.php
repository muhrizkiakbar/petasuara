<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desa extends Model
{
    //
    protected $table="desas";

    public function kecamatan(){
        return $this->belongsTo(kecamatan::class);
    }

    public function tps(){
        return $this->hasMany(tp::class);
    }

}
