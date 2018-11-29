<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnimalsExport implements FromCollection, WithHeadings
{

    protected $farm = NULL;
    protected $type = NULL;
    protected $gender = NULL;

    public function __construct($farm, $type, $gender)
    {
        $this->farm = $farm;
        $this->type = $type;
        $this->gender = $gender;
    }

    public function headings(): array
    {
        return [
            'Matricol Number',
            'Short Number',
            'Birth Date',
            'Father Interbull Code',
            'Mother Matricol Number',
            'Parity',
            'Last Calving Date',
        ];
    }

    public function collection()
    {
        $result =
            $this->farm->animals()
            ->with(['father', 'mother'])
            ->where('type', $this->type)
            ->where('gender', $this->gender)
            ->orderBy('matricol_number')
            ->get();
        $result = $result->map( function($item, $key) {
            $record = [
                'matricol_number' => $item->matricol_number,
                'short_number' => $item->pivot->short_number,
                'birth_date' => $item->birth_date,
                'father_interbull_code' => $item->father ? $item->father->interbull_code : NULL,
                'mother_matricol_number' => $item->mother ? $item->mother->matricol_number : NULL,
                'parity' => $item->parity,
                'last_calving_date' => $item->last_calving_date,
            ];
            return $record;
        });
        return $result;
    }
}
