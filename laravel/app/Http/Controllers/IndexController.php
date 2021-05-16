<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function show()
    {
        $titles = DB::table('artitles')->orderByDesc('id')->get();
        return view('index', compact('titles'));
    }
}
