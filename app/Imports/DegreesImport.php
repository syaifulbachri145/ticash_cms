<?php

namespace App\Imports;

use App\Models\Degree;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;

class DegreesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Degree([
        'institution_id'        => $row['institution_id'],
        'degree_name'           => $row['degree_name'],
        'status'                => $row['status'],
        ]);


    }

     public function rules(): array
    {
        return [
            'institution_id'    => 'required',
            'degree_name'       => 'required',
        ];
    }
}
