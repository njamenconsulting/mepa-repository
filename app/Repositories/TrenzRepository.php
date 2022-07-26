<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;

Class TrenzRepository
{
    const BASE_URL ="https://shop.trenz-electronic.de/";
    
    //
    public function getArticle(){
        $url = self::BASE_URL."api/articles?language=2";
        /* 
        $response = Http::withOptions([ 'verify' => public_path('certs/cacert.pem'),
                                       'Content-Type'=> 'application/json'])
                    ->withDigestAuth('mirifica-api', 'p0pdsCqGWQDnReEy85KnK8yCCAwRQpEhn6nNSCom')
                    ->get($url);
                    */
                                                                                  
        $certificate_location = public_path('certs/cacert.pem');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.trenz-electronic.de/api/articles?language=2',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_SSL_VERIFYHOST=> $certificate_location,
          CURLOPT_SSL_VERIFYPEER=> $certificate_location,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS =>'{
            "filter": [
                {
                    "property": "active",
                    "value": 1
                }
            ]
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
          ),
        ));
        
        //Execute cURL and return the string. depending on your resource this returns output like
        if(curl_exec($curl) === false) 
           dd('Erreur Curl : ' . curl_error($curl));
        else $response = curl_exec($curl);
        
        curl_close($curl);
        
        dd($response);
        
        return $response;
    }
    
}