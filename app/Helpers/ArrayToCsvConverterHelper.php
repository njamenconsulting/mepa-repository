<?php

namespace App\Helpers;

class ArrayToCsvConverterHelper
{
    /**
     * Convert a multi-dimensional, associative array to CSV data
     * @param  array $data the array of data
     * @return string       CSV text
     */

    public static function arrayToCsvConverter($data) {

        # Generate CSV data from array
        $fh = fopen('php://temp', 'rw'); # don't create a file, attempt
                                        # to use memory instead
        # write out the headers
        fputcsv($fh, array_keys(current($data)),";");

        # write out the data
        foreach ( $data as $row ) {

            if(is_array($row)) fputcsv($fh, $row,";");
            else dd($data,$row);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
    }
}