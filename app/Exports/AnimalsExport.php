<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnimalsExport implements FromCollection, WithHeadings, ShouldAutoSize
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
            'Farm Code',
            'Matricol Number',
            'Short Number',
            'Birth Date',
            'Sire ',
            'Dam',
            'Mother Grandsire',
            'Parity',
            'Last Calving Date',
            'Status',
        ];
    }

    public function collection()
    {
        $result =
            $this->farm->animals()
            ->with(['father', 'mother', 'mother.father'])
            ->where('type', $this->type)
            ->where('gender', $this->gender)
            ->wherePivot('deleted_at', NULL)
            ->orderBy('matricol_number')
            ->get();

        $result = $result->map( function($item, $key) {
            $record = [
                'farm_code' => $this->farm->external_id,
                'matricol_number' => $item->matricol_number,
                'short_number' => $item->pivot->short_number,
                'birth_date' => $item->birth_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->birth_date)->format('d-m-Y') : NULL,
                'father' => $item->father ? ($item->father->matricol_number ? $item->father->matricol_number : $item->father->interbull_code) : NULL,
                'mother' => $item->mother ? ($item->mother->matricol_number ? $item->mother->matricol_number : $item->mother->interbull_code) : NULL,
                'mother_father' => $item->mother && $item->mother->father ? ($item->mother->father->matricol_number ? $item->mother->father->matricol_number : $item->mother->father->interbull_code) : NULL,
                'parity' => $item->parity,
                'last_calving_date' => $item->last_calving_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->last_calving_date)->format('d-m-Y') : NULL,
                'status' => $item->pivot->status_in_farm,
            ];
            return $record;
        });
        return $result;
    }
}
