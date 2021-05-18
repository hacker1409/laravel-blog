<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'article_comments';

    public function saveComment($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function getCommentList($limit = 10, $offset = 0)
    {
        $total = DB::table($this->table)->count();
        $rows = DB::table($this->table)->limit($limit)->offset($offset)->orderByDesc('id')->get();
        return compact('total', 'rows');
    }

    public function getCommentListRandById($id)
    {
        $total = DB::table($this->table)->where('id', '>=', $id)->count();
        $rows = DB::table($this->table)->where('id', '>=', $id)->orderByDesc('id')->get();
        return compact('total', 'rows');
    }
}
