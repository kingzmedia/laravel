<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kingzmedia\Comments\Traits\Comments;
use Nwidart\LaravelVideoable\Traits\HasVideos;

class NotificationsSettings extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];
    protected $hidden = [];


    public function server()
    {
        return $this->belongsTo( Server::class);
    }





}
