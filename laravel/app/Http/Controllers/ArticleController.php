<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{

    public function showList($order = 'id')
    {
        if (!in_array($order, ['id', 'update_time'])) {
            $order = 'id';
        }
        $articles = (new Article())->getArticleList($order);
        return view('index', compact('articles'));
    }


    public function showDetail($id)
    {
        $model = new Article();
        $article_info = $model->getArticleInfo($id);
        $article_info = $article_info[0] ?? [];

        $article_info->thumbs = empty($article_info->thumbs) ? [] : json_decode($article_info->thumbs, true);
        $article_info->attachments = empty($article_info->attachments) ? [] : json_decode($article_info->attachments, true);
        foreach ($article_info->attachments as $idx => $attach) {
            unset($article_info->attachments[$idx]);
            $article_info->attachments[$idx]['url'] = $attach;
            $article_info->attachments[$idx]['name'] = '测试名称';
        }
        //评论
        $comment_ret = (new Comment())->getCommentList(10, 0);
        $comment_list = $comment_ret['rows'];
        $comment_total = $comment_ret['total'];
        if (!empty($comment_list)) {
            $user_model = new User();
            foreach ($comment_list as &$comment) {
                $user_info = $user_model->getUsersById($comment->user_id, ['user_name', 'nick_name', 'avator']);
                $comment->user_name = $user_info->user_name;
                $comment->nick_name = $user_info->nick_name;
                $comment->avator = $user_info->avator;
                $comment->create_time = format_date(strtotime($comment->create_time));
            }
        }

        Redis::sadd('readed_article_ids', $id);
        $recommand_ids = Redis::sdiff('article_ids', 'readed_article_ids');

        $articles = [];
        if (!empty($recommand_ids)) {
            //文章推荐
            $articles = $model->getRandArticles($recommand_ids);
        }
        return view('detail', compact('article_info', 'articles', 'comment_list','comment_total'));
    }

    public function save(Request $request)
    {
        $name = $request->post('name');
        $summary = $request->post('summary');
        $contents = $request->post('contents');
        $type = $request->post('type', 1);
        $user_id = $request->post('user_id', 88);
        $data = compact('name', 'summary', 'type', 'user_id', 'contents');
        $data['create_time'] = date('Y-m-d H:i:s');
        $ret = DB::table('articles')->insertGetId($data);
        if ($ret) {
            return 'success';
        } else {
            return 'fail';
        }
    }

}
