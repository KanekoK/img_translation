<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Ocr extends BaseController
{
    /**
    * 
    *
    *
    */
    public function post_check(Request $request) {
        $from_lang = $request->input('from_lang');
        $to_lang = $request->input('to_lang');
        $post = compact('from_lang', 'to_lang');
        return $post;
    }
}
