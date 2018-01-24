<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    //
    protected $table="kecamatans";

    public function kabupaten(){
        return $this->belongsTo(kabupaten::class);
    }

    public function kecamatan(){
        return $this->hasMany(desa::class);
    }
}
