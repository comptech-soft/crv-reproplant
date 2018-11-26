<?php

namespace App\Imports;

// use App\\User;
use Maatwebsite\Excel\Concerns\ToModel;

class SiresImport implements ToModel
{

    public function model(array $row)
    {
        dd($row);
    }
}
