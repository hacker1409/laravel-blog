<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function show()
    {
        $titles = DB::table('titles')->get();
        return view('index', compact('titles'));
    }
}
