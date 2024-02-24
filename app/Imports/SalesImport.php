<?php

namespace App\Imports;

use App\Sale;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sale([
            'nama'          => $row['nama'],
            'alamat'        => $row['alamat'],
            'perusahaan'        => $row['perusahaan'],
            'email'         => $row['email'],
            'telepon'       => $row['telepon']
        ]);
    }
}
