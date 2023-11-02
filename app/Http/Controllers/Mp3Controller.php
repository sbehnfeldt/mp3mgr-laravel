<?php

namespace App\Http\Controllers;

use App\Models\Mp3File;


class Mp3Controller extends Controller
{
    public function index()
    {
        return Mp3File::with('artist')->with('album')->paginate(50);
    }
}
