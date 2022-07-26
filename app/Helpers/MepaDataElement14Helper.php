<?php

namespace App\Helpers;

class MepaDataElement14Helper
{
    const BASE_URL = 'https://api.element14.com/catalog/products';

    public static function extratedDataForMepa($array)
    {
       // dd($array); 
        for ($i=0; $i < count($array); $i++) { 

            $data[$i] = array(  'sku' => $array[$i]['sku'],
                            'displayName' => $array[$i]['displayName'] ,
                            'productStatus' => $array[$i]['productStatus'] ,
                            'rohsStatusCod' => $array[$i]['rohsStatusCode'] ,
                            'packSize' => $array[$i]['packSize'] ,
                            'unitOfMeasure' => $array[$i]['unitOfMeasure'] ,
                            'id' => $array[$i]['id'] ,
                            'image' => self::BASE_URL.$array[$i]['image']['baseName'] ,
                            'prices' => $array[$i]['prices'][0]['cost'] ,
                            'inv' => $array[$i]['inv'],
                            'vendorId' => $array[$i]['vendorId'],
                            'vendorName' => $array[$i]['vendorName'],
                            'translatedManufacturerPartNumber' => $array[$i]['translatedManufacturerPartNumber']
                       );                       
        }

        return $data;
    }

    
        
/*
 - Manufacturer article code / manufacturer part number
- Commercial name / Name of the item
- Price			
- Supplier article code / like Mouser part number or Digikey part number
- Image	
- Computer board brand / the name of the manufacturer
*/

}