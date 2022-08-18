<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;

Class TrenzRepository
{
    const BASE_URL ="https://shop.trenz-electronic.de/";
    
    //
    public function getArticle(){
        $url = self::BASE_URL."api/articles";
        //$response = Http::withOptions(['verify' => public_path('certs/cacert.pem')])->withDigestAuth('mirifica-api', 'p0pdsCqGWQDnReEy85KnK8yCCAwRQpEhn6nNSCom')
        //                                                                            ->get($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "mirifica-api:p0pdsCqGWQDnReEy85KnK8yCCAwRQpEhn6nNSCom");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        // validate HTTP status code (user/password credential issues)
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code != 200) echo $status_code;

        echo $response;
        dd($status_code);
        
        return $response;
    }
    
}