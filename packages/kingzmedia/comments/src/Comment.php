<?php namespace Kingzmedia\Comments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Comment extends Model
{
    protected $fillable = ['comment'];

    public function user()
    {
        return $this->belongsTo(config('comments.user_model'));
    }

    public function data() {
        return ($this->content_type)::where("id",$this->content_id)->first();
    }

    public function getReplyAuthor() {
        if($this->reply == 0) return false;

        $comment = Comment::where("id",$this->reply)->first();
        return $comment->user()->first();
    }

    public function content()
    {
        return $this->morphTo()->withTimestamps();
    }

    /**
     * Gets users who commented on content,
     * except the user of this comment.
     *
     * Useful for notifying users about a new comment.
     *
     * @return Collection
     */
    public function getUsersWhoCommented()
    {
        $content_id = $this->content->id;
        $content_type = $this->content()->first()->getMorphClass();
        $user_id = $this->user->id;

        return $this
            ->where('content_id', $content_id)
            ->where('content_type', $content_type)
            ->where('user_id', '!=', $user_id)
            ->get()
            ->pluck('user')
            ->unique();
    }

    public function childrenAttributes()
    {
        return array();
    }

    public static function getComments($model, $model_id)
    {
        $comments = self::where("content_id", $model_id)->where("content_type", $model)->get();

        $refactor = array();
        foreach ($comments as $comment) {
            if ($comment->reply == 0) {
                $comment->childrens = array();
                $refactor[$comment->id] = $comment;
            } else {
                $refactor[$comment->reply]->attributes["childrens"][$comment->id] = $comment;
            }
        }

        return $refactor;
    }


    public function delete()
    {

        /**
         * Cascade delete children comments
         */
        $data = Comment::where("reply", $this->id)->get();
        foreach ($data as $comment) {
            $comment->delete();
        }

        /**
         * Delete self
         */
        parent::delete();
    }
}
