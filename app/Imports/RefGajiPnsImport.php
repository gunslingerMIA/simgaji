<?php

namespace App\Imports;

use App\Models\RefGajiPokokPns;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RefGajiPnsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return RefGajiPokokPns::updateOrCreate(
            [
                'golongan' => $row['golongan'],
                'mkg' => $row['mkg'],
            ],
            [
                'nominal' => $row['nominal'],
            ]
        );
    }
}
