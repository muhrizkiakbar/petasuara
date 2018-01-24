<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kabupaten extends Model
{
    //
    protected $table="kabupatens";

    public function kecamatan(){
        return $this->hasMany(kecamatan::class);
    }
}
