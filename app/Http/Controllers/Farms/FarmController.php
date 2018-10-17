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
}