<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function getArticleList($field = 'id')
    {
        return DB::table($this->table)->orderByDesc($field)->get();
    }

    public function getArticleInfo($id)
    {
        return DB::table($this->table . ' as a')
            ->select(['a.*', 'i.contents'])
            ->join('article_infos  as i', 'a.id', '=', 'i.article_id')
            ->where('a.id', '=', $id)
            ->get();
    }

    public function getRandArticles($ids)
    {
        return DB::table($this->table)
            ->inRandomOrder()->take(5)
            ->whereIn('id', $ids)
            ->get();
    }
}
