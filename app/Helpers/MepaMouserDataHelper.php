<?php

namespace App\Helpers;

class MepaMouserDataHelper
{
    public static function extractedDataForMepa($array)
    {
       // dd($array);
        for ($i=0; $i < count($array); $i++) { 
            $mepaData[$i] = [
                                'Availability'=> $array[$i]['Availability'],
                                'DataSheetUrl'=> $array[$i]['DataSheetUrl'],
                                'Description'=>  $array[$i]['Description'],
                                'productImage'=> $array[$i]['ImagePath'],
                                'Category'=> $array[$i]['Category'],
                                'manufacturerName'=> $array[$i]['Manufacturer'],
                                'manufacturerCode'=> $array[$i]['ManufacturerPartNumber'],
                                //'productName'=>  $array[$i][''],
                                'PriceBreaks'=> $array[$i]['PriceBreaks'],
                                'supplierCode'=> $array[$i]['MouserPartNumber'],
                                'productDetail'=> $array[$i]['ProductDetailUrl']
                            ];
        }
        return $mepaData;
    }
}