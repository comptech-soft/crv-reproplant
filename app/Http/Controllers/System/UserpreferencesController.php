<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Files\Upload;

class UserpreferencesController extends Controller
{

    public function savePreferences(Request $request)
    {
        return $request->all();
    }

}
