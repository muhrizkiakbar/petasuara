<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;

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

    public function tps(){
        return $this->belongsTo(tp::class);
    }

    public function punyaRule($namarole){
        $modaluser=$this->role->namarole;

        if (count($namarole)== 1)
        {
            if ($this->role->namarole == $namarole[0])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        elseif (count($namarole)== 2)
        {
            if ($this->role->namarole == $namarole[0]) {
                return true;
            } elseif ($this->role->namarole == $namarole[1]) {
                return true;
            }  else {
                return false;
            }
        }
        elseif (count($namarole)== 3)
        {
            if ($this->role->namarole == $namarole[0]) {
                return true;
            } elseif ($this->role->namarole == $namarole[1]) {
                return true;
            } elseif ($this->role->namarole == $namarole[2]) {
                return true;
            } else {
                return false;
            }
        }
        elseif (count($namarole)== 4)
        {
            if ($this->role->namarole == $namarole[0]) {
                return true;
            } elseif ($this->role->namarole == $namarole[1]) {
                return true;
            } elseif ($this->role->namarole == $namarole[2]) {
                return true;
            } elseif ($this->role->namarole == $namarole[3]) {
                return true;
            }
             else {
                return false;
            }
        }
    
    }
}
