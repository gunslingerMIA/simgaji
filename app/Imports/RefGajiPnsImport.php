<?php

namespace App\Imports;

use App\Models\RefGajiPokokPns;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RefGajiPnsImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
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
