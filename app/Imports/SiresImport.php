<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class SiresImport implements ToCollection
{
    use Importable;
    
    public function collection(Collection $collection)
    {
        return $collection;
    }
}
