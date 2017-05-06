<?php

namespace Kingzmedia\Comments\Listeners;

use App\Notifications\UserCreated;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Kingzmedia\Comments\Comment;
use Kingzmedia\Comments\Notifications\CommentCreated;
use Kingzmedia\Comments\Notifications\CommentResponse;

class CommentsEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function beforeCommentPost($comment)
    {


        // Vérifier si le post existe
        $check = ($comment->content_type)::where("id", $comment->content_id)->first();
        if (sizeof($check) <= 0) {
            return false;
        }

        // Vérifier si le post est commentable
        if (isset($check->is_commentable) && (!$check->is_commentable || $check->is_commentable == "0")) {
            return false;
        }

        // Vérifier si en cas de réponse, le commentaire existe
        if ($comment->reply != null && $comment->reply > 0) {
            $check = Comment::where("id", $comment->reply)->where("content_id", $comment->content_id)->where("content_type", $comment->content_type)->get();
            if (sizeof($check) <= 0) {
                return false;
            }
        }
        return true;

        Event::fire("comments.posting", array($comment));

    }

    public function onCommentPost($comment)
    {

        Event::fire("comments.posted", array($comment));

        $reply_author = $comment->getReplyAuthor();
        $from = $comment->user()->first();
        if ($reply_author && $reply_author->email != $from->email) {
            $reply_author->notify(new CommentResponse($from,$comment));
        }

        $post_author = $comment->data()->user()->first();
        if($post_author->email != $from->email) {
            $post_author->notify(new CommentCreated($from,$comment));
        }
        //


    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'eloquent.saved: Kingzmedia\Comments\Comment',
            'Kingzmedia\Comments\Listeners\CommentsEventSubscriber@onCommentPostLogin'
        );
    }

}