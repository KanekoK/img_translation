<?php

namespace App\Http\Controllers;

use Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Ocr extends BaseController
{
    /**
    * 
    *
    *
    */
    public function post_check(Request) {
        $from_lang = Request::input('from_lang');
        $to_lang = Request::input('to_lang');
        $post = compact('from_lang', 'to_lang');
        return $post;
    }
}
