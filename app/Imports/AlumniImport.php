<?php

namespace App\Imports;

use App\Models\Alumnus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Alumnus([
            'name'              => $row['name'],
            'graduation_year'   => $row['graduation_year'],
            'occupation'        => $row['occupation'],
        ]);
    }
}
