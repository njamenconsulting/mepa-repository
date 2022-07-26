<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;

Class MouserRepository
{
    private $_url;

    private $_curlService;
    //
    public function __construct()
    {
        $this->_url = 'https://api.mouser.com/api/v1/search/keyword?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70';
        $this->_curlService = new CurlService();
    }
    //
    public function getPartsByKeyword($array)
    {
        //on recupère (couper) le dernier element du tableau 
        $version = array_pop($array);
        $data['SearchByKeywordRequest'] = $array;
      
        $this->_url = 'https://api.mouser.com/api/'.$version.'/search/keyword?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70';

        $fields = json_encode($data);

        $header = array(
                        'Content-Type: application/json', // if the content type is json
                       );
        return $this->_curlService->postRequest($this->_url, $fields, $header);

    }
    //
    public function getmanufacturerlist()
    {
        $url = "https://api.mouser.com/api/v2/search/manufacturerlist?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70";
        return $this->_curlService->getRequest($url);
    }
}