<?php namespace Kingzmedia\Comments\Traits;

use Kingzmedia\Comments\Comment;

trait Comments
{


    public function comments()
    {
        return $this->morphMany(Comment::class, 'content');
    }

    public function delete()
    {
        foreach($this->comments as $comment) {
            $comment->delete();
        }
        parent::delete();
    }

}
