<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Element14Repository;
use App\Helpers\{MepaDataElement14Helper,ArrayToCsvConverterHelper};

class Element14Controller extends Controller
{
    function __construct()
    {
        $this->_element14Repository = new Element14Repository();
    }  
    public function index()
    {
        return view('element14.element14_index');
    }
    //
    public function getFormKeywordSearch()
    {
        return view('element14.form_keywordsearch');
    }
    //    
    /**
     * postFormKeywordSearch
     *
     * @param  mixed $request
     * @return void
     */
    public function postFormKeywordSearch(Request $request)
    {
        #Post data validation
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'storeInfo' => 'required|string',
            'numberOfResults' => 'integer',
            'filters' => 'string',
            'responseGroup' => 'string',
        ]);
        
        $response = $this->_element14Repository->keywordSearch($validated);
        $arrayData = json_decode($response,true);

        $NumberOfResult  = $arrayData['keywordSearchReturn']['numberOfResults'];
        $nbOfRequest = $NumberOfResult/50;
        $mepaData = array();

        foreach ($arrayData as $key => $value) {
            # Retrieving the number of products found
            $NumberOfResultReturned = $value['numberOfResults'];
            $NumberOfResultReturned = 200;
            $mepaData[0] = MepaDataElement14Helper::extratedDataForMepa($value['products']);
            
            for ($i=1; $i < $NumberOfResultReturned/25 ; $i++) { 
                
                # Retrieving the 25 results /loop
                $extractedDataForMepa[$i] = MepaDataElement14Helper::extratedDataForMepa($value['products']);
                //
                $mepaData[0] = array_merge($mepaData[0],$extractedDataForMepa[$i]);
               
            }  
        }

        #Convert array returned from API in csv file
        $csvContent = ArrayToCsvConverterHelper::arrayToCsvConverter($mepaData[0]);
      dd($csvContent);
        return response($csvContent)
                ->withHeaders([
                                'Content-Type' => 'application/csv',
                                'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-element14-'.$validated["keyword"].'.csv',
                                'Content-Transfer-Encoding' => 'UTF-8',
                            ]);

    }
}
