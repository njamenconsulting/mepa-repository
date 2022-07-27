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
    public function postFormKeywordSearch(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'storeInfo' => 'required|string',
            'numberOfResults' => 'integer',
            'filters' => 'string',
            'responseGroup' => 'string',
        ]);

        $response = $this->_element14Repository->keywordSearch($validated);
        $arrayData = json_decode($response,true);

        $extractedDataForMepa = MepaDataElement14Helper::extratedDataForMepa($arrayData['keywordSearchReturn']['products']);
        
        $csvContent = ArrayToCsvConverterHelper::arrayToCsvConverter($extractedDataForMepa);
       
        return response($csvContent)
        ->withHeaders([
                        'Content-Type' => 'application/csv',
                        'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-element14-'.$validated["keyword"].'.csv',
                        'Content-Transfer-Encoding' => 'UTF-8',
                    ]);

    }
}
