<?php

namespace App\Imports;

use App\Models\RefGajiPokokPppk;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RefGajiPppkImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
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
