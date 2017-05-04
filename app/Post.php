<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kingzmedia\Comments\Traits\Comments;
use Nwidart\LaravelVideoable\Traits\HasVideos;

class Post extends Model
{
    use Notifiable, HasVideos, \Conner\Likeable\LikeableTrait, Comments, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',  'content', 'is_commentable',
    ];




    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



}
