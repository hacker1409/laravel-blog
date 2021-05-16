<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtitleController extends Controller
{
    //
    public function save(Request $request)
    {
        $title = $request->post('title');
        $sub_title = $request->post('sub_title');
        $key_words = $request->post('key_words');
        $contents = $request->post('contents');
        $user_id = $request->post('user_id', 88);
        $thumbs = $request->post('thumbs', '');
        $attachments = $request->post('attachments', '');
        $data = compact('title', 'sub_title', 'key_words', 'contents', 'user_id', 'thumbs', 'attachments');
        $ret = DB::table('artitles')->insert($data);
        if ($ret) {
            return 'success';
        } else {
            return 'fail';
        }
    }
}
