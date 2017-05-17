<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerUpdateController extends Controller
{
    public function update(Request $request) {
        return array("ok");
    }
}
