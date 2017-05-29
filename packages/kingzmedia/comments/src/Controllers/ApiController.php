<?php
namespace Kingzmedia\Comments\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Kingzmedia\Comments\Comment;
use App;
use Validator;
class ApiController extends Controller
{

    public function show($model,$model_id)
    {
        $class = "App\\".$model;
        return Comment::getComments($class,$model_id);
    }

    public function store($model,$model_id, Request $request)
    {
        $model = $class = "App\\".$model;

        $validator = Validator::make($request->all(), array(
            'comment' => 'required|string'
        ));
        if($validator->fails()) {
            return array("success" => false, "errors" => $validator->errors()->getMessages());
        }

        $model = $this->getModel(
            $model,
            $model_id
        );

        $comment = new Comment;
        $comment->user()->associate(auth()->user());
        $comment->content()->associate($model);
        $comment->comment = $request->get('comment');
        if($request->get("reply",false)) {
            $comment->reply = Comment::findOrFail(intval($request->get("reply")))->id;
        }
        $comment->save();

        dump($comment);
        //return $this->syndra->respondCreated();
    }


    protected function getModel($content, $id)
    {
        return $content::findOrFail($id);
    }



    protected function baseValidate(array $data, array $additional_rules = [])
    {
        return Validator::make($data,
            array_merge($this->getBasicRules(), $additional_rules)
        );
    }

    protected function getBasicRules()
    {
        return [
            'content_type' => 'required|string|in:' . $this->getValidContentTypeString(),
            'content_id' => 'required|int|min:1'
        ];
    }

    protected function getValidContentTypeString()
    {
        return implode(',', config('comments.content'));
    }

}
?>