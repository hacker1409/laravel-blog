<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    //
    public function show($id)
    {
        $title = DB::table('titles')->find($id);
        $title->thumbs = empty($title->thumbs) ? [] : json_decode($title->thumbs, true);
        $title->attachments = empty($title->attachments) ? [] : json_decode($title->attachments, true);
        foreach ($title->attachments as $idx => $attach) {
            unset($title->attachments[$idx]);
            $title->attachments[$idx]['url'] = $attach;
            $title->attachments[$idx]['name'] = '测试名称';
        }
        $title->attachments[1]['url'] = $attach;
        $title->attachments[1]['name'] = '测试名称12';
        $titles = DB::table('titles')->limit(8)->get();
        return view('detail', compact('title', 'titles'));
    }
}
