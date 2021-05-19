<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $table_info = 'article_infos';

    public function getArticleList($offset = 0)
    {
        $list = DB::table($this->table)->limit(15)->offset($offset)->orderByDesc('id')->get();
        $total = DB::table($this->table)->count();
        return compact('list', 'total');
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

    public function saveArticle($name, $summary, $type, $user_id, $contents)
    {
        $create_time = date('Y-m-d H:i:s');
        $update_time = date('Y-m-d H:i:s');
        $article_data = compact('name', 'summary', 'type', 'user_id', 'create_time', 'update_time');
        DB::beginTransaction();

        try {
            $article_id = DB::table($this->table)->insertGetId($article_data);
            if (!$article_id) {
                DB::rollBack();
            }
            $info_data = compact('article_id', 'contents', 'create_time', 'update_time');
            $id = DB::table($this->table_info)->insertGetId($info_data);
            if (!$id) {
                DB::rollBack();
            }
            DB::commit();
            return $article_id;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }
}
