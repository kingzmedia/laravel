<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Kingzmedia\Comments\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testComments()
    {

        // Création de l'utilisateur
        $this->user = User::create(["name" => "test", "email" => "john@doe.com", "password" => "azerty"]);
        $user2 = User::create(["name" => "touille", "email" => "user2@john.com", "password" => "azerty"]);
        $user3 = User::create(["name" => "sdsfdsfsd", "email" => "user3@john.com", "password" => "azerty"]);

        // Création du Post
        $this->post = new Post(["title" => "Titre du post","content" => "Le message est ici"]);
        $this->post->user()->associate($this->user);
        $this->post->save();

        // Vérification de l'existance du Post
        $this->assertEquals(1, Post::count());

        // Vérifications de la génération du slug
        $this->assertEquals($this->post->slug, "titre-du-post");


        // Création d'un commentaire de l'utilisateur 1 sur le post 1
        $comment = new Comment;
        $comment->user()->associate($this->user);
        $comment->content()->associate($this->post);
        $comment->comment = "lorem ipsum dolor xxx";
        $comment->save();




        // Création d'un deuxieme commentaire au post 1
        $comment3 = new Comment;
        $comment3->user()->associate($user3);
        $comment3->content()->associate($this->post);
        $comment3->comment = "2eme commm";
        $comment3->save();


        // Création d'une réponse au comment 1
        $comment2 = new Comment;
        $comment2->user()->associate($user2);
        $comment2->content()->associate($this->post);
        $comment2->reply = $comment->id;
        $comment2->comment = "Réponse du premier";
        $comment2->save();


        // TOTAL 4 COMMENTAIRES
        $this->assertEquals(3, Comment::count());



        // On récupère les commentaires
        $comments = Comment::getComments(Post::class, $this->post->id);


        // Verify if the user information can be retrieved
        $single = Comment::first()->user()->get()->first();
        $this->assertEquals("test",$single->name);


        // DEUX COMMENTAIRES PRINCIPAUX AU POST 1
        $this->assertEquals(2, sizeof($comments));


 
        $content = $this->get("/api/v1/comments/Post/1")->getContent();
    }


    public function testApi() {


    }
}
