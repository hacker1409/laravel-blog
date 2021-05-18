<?php

namespace App\Http\Controllers;

use App\User;
use  App\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function save(Request $request)
    {
        $user_id = $request->post('user_id');
        $article_id = $request->post('article_id');
        $contents = $request->post('contents');
        $create_time = date('Y-m-d H:i:s');
        $data = compact('user_id', 'article_id', 'contents', 'create_time');
        return (new Comment())->saveComment($data);
    }

    public function ajaxShow($id = 0)
    {
        $comment_ret = (new Comment())->getCommentListRandById($id);
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
        return compact('comment_list', 'comment_total');
    }

    public function ajaxByPage($page = 1)
    {
        $comment_ret = (new Comment())->getCommentList(10, ($page - 1) * 10);
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
        return compact('comment_list', 'comment_total');
    }

}
