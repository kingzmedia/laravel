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
        'name', 'email', 'password', 'locale'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function servers()
    {
        return $this->hasMany('App\Server');
    }

    public function apiKeyGeneration() {
        $return = "";
        $values = "abcdefghijklmnopqrstuvwxyz0123456789-_#@|";
        $len = strlen($values)-1;
        for($i=0;$i<20;$i++) {
            $isMaj = rand(1,2);
            $pos = rand(0,$len);
            $tmp = $values[$pos];
            if($isMaj == 2) {
                $tmp = strtoupper($tmp);
            }
            $return .= $tmp;
        }
        return $return;
    }


}
