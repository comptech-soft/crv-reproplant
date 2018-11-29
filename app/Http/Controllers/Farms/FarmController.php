<?php

namespace App\Http\Controllers\Farms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farms\Farms\Farm;

class FarmController extends Controller
{

    /**
     * Salveaza orele mulsorilor pentru o ferma
     */
    public function saveOreMulsori(Request $request)
    {
        return Farm::saveOreMulsori($request->only(['farm_id', 'ora']));
    }

    /**
     * Actualizeaza informatiile despre un user
     */
    public function saveUser(Request $request)
    {
        return Farm::saveUser($request->only(['action', 'record', 'farm_id', 'old']));
    }

    /**
     * Actualizeaza informatiile despre o vaca
     */
    public function saveCow(Request $request)
    {
        return Farm::saveCow($request->only(['action', 'record', 'farm_id', 'old']));
    }

    /**
     * Ataseaza un animal la o ferma
     */
    public function attachAnimal(Request $request)
    {
        return Farm::attachAnimal($request->only(['animal_id', 'farm_id', 'status_in_farm']));
    }

    /**
     * Upload fisier cu taurii de la ferma
     */
    public function siresUpload(Request $request)
    {
        return Farm::siresUpload($request->all());
    }

    /**
     * Import fisier cu taurii de la ferma
     */
    public function siresImport(Request $request)
    {
        return Farm::siresImport($request->all());
    }

    /**
     * Stergerea animalelor
     */
    public function animalsDelete(Request $request)
    {
        return Farm::animalsDelete($request->all());
    }

    /**
     * Download animale
     */
    public function animalsDownload(Request $request)
    {
        return Farm::animalsDownload($request->all());
    }
}