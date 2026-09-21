<?php

namespace App\Imports;

use App\Models\RefGajiPokokPppk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RefGajiPppkImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return RefGajiPokokPppk::updateOrCreate(
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
