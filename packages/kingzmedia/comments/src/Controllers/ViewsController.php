<?php
namespace Kingzmedia\Views\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewsController extends Controller
{

    public function top($type)
    {
        dd("ok");
    //echo Carbon::now($timezone)->toDateTimeString();
    }

}
?>