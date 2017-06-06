<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kingzmedia\Comments\Traits\Comments;
use Nwidart\LaravelVideoable\Traits\HasVideos;

class Server extends Model
{
    use Notifiable, Comments;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ip'
    ];
    protected $hidden = [];


    public function user()
    {
        return $this->belongsTo( User::class);
    }

    public function notifications() {
        return $this->hasMany('App\NotificationsSettings');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }




}
