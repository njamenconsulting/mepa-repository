<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MouserRepository;
use App\Helpers\JsonToCsvHelper;
use App\Helpers\{ArrayToCsvConverterHelper,MepaMouserDataHelper};

class MouserController extends Controller
{    
    /**
     * _mouserRepository
     *
     * @var MouserRepository
     */
    private $_mouserRepository;
   
    function __construct()
    {
        $this->_mouserRepository = new MouserRepository();
    }   
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('mousers.mouser_index');
    }
    //
    public function getPartsByKeyword(Request $request,JsonToCsvHelper $jsonToCsvHelper )
    {
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'records' => 'integer',
            'startingRecord' => 'integer',
            'searchOptions' => 'string',
            'searchWithYourSignUpLanguage' => 'string',
            'version' => 'required|string',
        ]);
       // $mepaData 
        $jsonData = $this->_mouserRepository->getPartsByKeyword($validated);
       // dd($jsonData);
        $arraydata = json_decode($jsonData,true);
        //dd($arraydata);
        $data['parts']=MepaMouserDataHelper::extractedDataForMepa($arraydata['SearchResults']['Parts']);
        //dd($data);
        //return view('mousers.mouser_index',$data);
        
        
        //Delete all key who has an array
        for ($i=0; $i < count($arraydata['SearchResults']['Parts']); $i++) { 
            unset($arraydata['SearchResults']['Parts'][$i]["ProductAttributes"]);
            //unset($arraydata['SearchResults']['Parts'][$i]["PriceBreaks"]);
            unset($arraydata['SearchResults']['Parts'][$i]["InfoMessages"]);
            unset($arraydata['SearchResults']['Parts'][$i]["ProductCompliance"]);
            unset($arraydata['SearchResults']['Parts'][$i]["AlternatePackagings"]);
            
        }
        
        $csv = $jsonToCsvHelper::JsonToCsvHelper($arraydata['SearchResults']['Parts']);

        return response($csv)
                    ->withHeaders([
                        'Content-Type' => 'application/csv',
                        'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-mouser-'.$validated["keyword"].'.csv',
                        'Content-Transfer-Encoding' => 'UTF-8',
                    ]);         
    }

    public function manufacturerList()
    {
        $response = $this->_mouserRepository->getmanufacturerlist();
        echo $response;
    }
}
