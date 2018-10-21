<?php

namespace App\Http\Controllers\Animals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crv4All\Imports\Import;
use App\Models\Animals\Animals\Animal;

class AnimalController extends Controller
{

    public function crv4allImport(Request $request)
    {
        return (new Import())->getAnimalTraits($request->only(['interbull_code', 'calculation_base']));
    }

    /**
     * Aduce din tabela [animal_traits] detaliile despre un animal
     */
    public function getAnimalCharacteristics(Request $request)
    {
        return Animal::getAnimalCharacteristics($request->only('animal_id'));
    }

    
}