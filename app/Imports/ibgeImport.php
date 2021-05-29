<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;

class ibgeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new City([
            'name'              => $row[0],
            'catholic'          => $row[1],
            'evangelical'       => $row[2],
            'without_religion'  => $row[3],
            'spiritist'         => $row[4],
            'youngs'            => $row[5],
            'adults'            => $row[6],
            'elderlies'         => $row[7],
            'urban'             => $row[8],
            'rural'             => $row[9],
        ]);
    }
}
