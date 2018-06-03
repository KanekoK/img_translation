<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Ocr extends BaseController
{
    /**
    * 
    *
    */
    public function post_check(Request $request) {
        $from_lang = $request->input('from_lang');
        $to_lang = $request->input('to_lang');
        $post = compact('from_lang', 'to_lang');
        return $post;
    }

    public function setting_api($api_key) {
        // 画像のパス
        $image_path = "./test.png";
        // リクエスト用のJSONを作成
        $json = json_encode( array(
            "requests" => array(
                array(
                    "image" => array(
                        "content" => base64_encode( file_get_contents( $image_path ) ) ,
                    ) ,
                    "features" => array(
                        array(
                            "type" => "TEXT_DETECTION" ,
                            "maxResults" => 3 ,
                        ) ,
                    ) ,
                ) ,
            ) ,
        ) ) ;

        // リクエストを実行
        $curl = curl_init() ;
        curl_setopt( $curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key ) ;
        curl_setopt( $curl, CURLOPT_HEADER, true ) ; 
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" ) ;
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ) ) ;
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false ) ;
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;
        if ( isset($referer) && !empty($referer) ) curl_setopt( $curl, CURLOPT_REFERER, $referer ) ;
        curl_setopt( $curl, CURLOPT_TIMEOUT, 15 ) ;
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json ) ;
        $res1 = curl_exec( $curl ) ;
        $res2 = curl_getinfo( $curl ) ;
        curl_close( $curl ) ;

        // 取得したデータ
        $json = substr( $res1, $res2["header_size"] ) ;             // 取得したJSON
        $header = substr( $res1, 0, $res2["header_size"] ) ;        // レスポンスヘッダー

        // 出力
        echo "<h2>JSON</h2>" ;
        echo $json ;

        echo "<h2>ヘッダー</h2>" ;
        echo $header ;
    }

    public function test() {
        return Config::get('appkey.vision_key');
    }

    public function main() {
        test();
    }
}
