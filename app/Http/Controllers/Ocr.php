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
    public function __construct() {
        $this->gcp_key = env('GCP_KEY');
    }

    public function post_check(Request $request) {
        $from_lang = $request->input('from_lang');
        $to_lang = $request->input('to_lang');
        $post = compact('from_lang', 'to_lang');
        return $post;
    }

    private function img2txt() {
        // 画像のパス
        $image_path = "./img/test.png";
        // リクエスト用のJSONを作成
        $json = json_encode( array(
            "requests" => array(
                array(
                    "image" => array(
                        "content" => base64_encode( file_get_contents( $image_path ) ) ,
                    ) ,
                    "features" => array(
                        array(
                            "type" => "TEXT_DETECTION",
                            "maxResults" => 10,
                        ) ,
                    ) ,
                ) ,
            ) ,
        ) ) ;

        // リクエストを実行
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $this->gcp_key);
        // curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ( isset($referer) && !empty($referer)) {
            curl_setopt($curl, CURLOPT_REFERER, $referer);
        }
        curl_setopt( $curl, CURLOPT_TIMEOUT, 15);
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json);
        $res = curl_exec($curl);
        curl_close($curl);

        // 取得したデータ
        $data = json_decode($res, true);
        return $data["responses"][0]["fullTextAnnotation"]["text"];
    }

    private function zh2ja($target_txt) {
        $url = "https://vision.googleapis.com/v1/images:annotate?key=";
        $api_url  = $url . $this->gcp_key;
        $formated_url = $api_url . "&q=" . $target_txt . "&source=zh&target=ja";

        // リクエストを実行
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $formated_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, $json);
        $res = curl_exec($curl);
        curl_close($curl);

        // 取得したデータ
        $data = json_decode($res, true);
        var_dump($res);
        return $data["data"]["translations"][0]["translatedText"];
    }

    public function main() {
        $china_txt = $this->img2txt();
        $this->zh2ja($china_txt);
    }
}
