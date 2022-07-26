<?php

namespace App\Helpers;

class JsonToCsvHelper
{
    public static function JsonToCsvHelper($data)
    {
        # Start the ouput
        $filePointer = fopen('php://temp', 'rw');

        # write out the headers
        fputcsv($filePointer, array_keys(current($data)));

        // Traverse through the associative array using for each loop
        //$data = array_merge(array(array_keys($data[0])), $data);
        
        $priceBreak = "";
        foreach($data as $row){
      
            for ($i=0; $i < count($row['PriceBreaks']); $i++) { 
                $quantity = $row['PriceBreaks'][$i]['Quantity'];
                $price = $row['PriceBreaks'][$i]['Price'];
                $priceBreak .= $quantity."/".$price."-";
            }
            $row['PriceBreaks']=$priceBreak;
            // Write the data to the CSV file
       
            fputcsv($filePointer, $row);
        }

        rewind($filePointer);
        // put it all in a variable
        $output = stream_get_contents($filePointer);
        
        // Close the file pointer.
        fclose($filePointer);

        return $output;
    }
 
}