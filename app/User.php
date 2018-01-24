<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namauser', 'password','alamatuser','username','nohpuser','noktpuser','tps_id','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo(role::class);
    }

    public function tp(){
        return $this->belongsTo(tp::class);
    }

    public function punyaRule($namaRole){
        $modaluser=$this->role->namaRole;

        if (count($namaRole)== 1)
        {
            if ($this->role->namaRole == $namaRole[0])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        elseif (count($namaRole)== 2)
        {
            if ($this->role->namaRole == $namaRole[0]) {
                return true;
            } elseif ($this->role->namaRole == $namaRole[1]) {
                return true;
            }  else {
                return false;
            }
        }
        elseif (count($namaRole)== 3)
        {
            if ($this->role->namaRole == $namaRole[0]) {
                return true;
            } elseif ($this->role->namaRole == $namaRole[1]) {
                return true;
            } elseif ($this->role->namaRole == $namaRole[2]) {
                return true;
            } else {
                return false;
            }
        }
    
    }
}
