<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::all();
        /*$flights = App\Flight::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->get();*/
        return view('posts.home', ["posts" => $posts]);
    }

    public function read($slug,$id) {
        $post = Post::find(intval($id));


        return view('posts.read', ["post" => $post]);
    }
}
