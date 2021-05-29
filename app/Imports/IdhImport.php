<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;

class IdhImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cities = City::all();
        foreach ($cities as $city) {
            if ($city->name == $row[0]) {
                $city->idh = $row[2];
                $city->update();
            }
        }
    }
}
