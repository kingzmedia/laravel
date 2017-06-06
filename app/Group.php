<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public $fillable = ["name","user_id"];

    public function servers()
    {
        return $this->belongsToMany('App\Server');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
