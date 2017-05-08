<?php
namespace Kingzmedia\Comments\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Kingzmedia\Comments\Comment;
use App;

class ApiController extends Controller
{

    public function show($model,$model_id)
    {
        $class = "App\\".$model;
        return Comment::getComments($class,$model_id);
    }

}
?>