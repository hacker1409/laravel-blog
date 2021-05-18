@extends('app')
@section('main_title', '文章详情')
<!--头部-->
@section('app_header')
    @parent
@endsection

<!--左侧-->
@section('app_left')
    @parent
@endsection

<!--右侧-->
@section('app_right')
    <div class="right">
        <div class="right-detail-title">
            <span><a href="{{asset('/')}}"><<&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
            <span>
                {{$article_info->name}}
            </span>
        </div>

        <div class="right-detail-title-contents">
            {{--<p>--}}
            <span><pre>{{$article_info->contents}}</pre></span>
            {{--</p>--}}
            @foreach($article_info->thumbs as $picture)
                <img src="{{$picture}}"/>
            @endforeach

        </div>
        <div class="right-detail-title-contents-attachement">
            <span>附件:</span>
            @foreach($article_info->attachments as $attach)
                <a href="{{$attach['url']}}" download="{{$attach['name']}}">{{$attach['name']}}</a>
            @endforeach
        </div>

        <div class="right-detail-title-comment">
            <div class="right-detail-title-comment-keywords">
                <span>概要 : {{$article_info->summary}}</span>
            </div>
            <div class="right-detail-title-comment-read">
                <span>时  间 : {{$article_info->create_time}}</span>
                <span>阅读数 : 5 </span>
                <span>评论数 : 3</span>
                <span>点赞数 : 4</span>
            </div>
        </div>

        <!--评论相关-->
        <div class="right-detail-comment-relation">
            <span><h3>最新评论</h3></span>

            <div class='right-detail-comment-relation-submit-form'>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form method="post" id="save_comments">
                    <textarea placeholder="请留下您宝贵的评论" rows="8" cols="100%" style="resize:none;"
                              name="comments"></textarea>
                </form>
                <button type="button" id="submit_comments" style="cursor:pointer">发表</button>
            </div>

            <script>
                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $("#submit_comments").click(function () {
                        var contents = $('textarea[name="comments"]').val();
                        if (!contents.trim()) {
                            alert('请填写评论内容');
                            return;
                        }
                        var user_id = 1;
                        var article_id = "{{$article_info->id}}";
                        $.post("{{asset('comment/save')}}",
                            {
                                contents: contents,
                                user_id: user_id,
                                article_id: article_id,
                            },
                            function (data, status) {
                                if (0 == data.code) {
                                    alert('fail')
                                } else {
                                    alert('success');
                                    $('textarea[name="comments"]').val("");
                                    //刷新数据
                                    var url = "{{asset('comment/ajaxShow')}}" + '/' + data;
                                    refresh_comment(url, true);
                                }
                            });
                    });

                    //设置页数和当前页
                    fillPages();
                });

                function fillPages() {
                    var total = $('input[name="listCount"]').val();
                    var page = $('input[name="currPage"]').val();
                    var maxPage = Math.ceil(total / 10);
                    var html = "共" + maxPage + "页 >>当前" + page + "页";
                    $("#countPages").html(html);
                }


                //拉取数据
                function refresh_comment(url, need_append = false) {
                    $.get(url,
                        {},
                        function (data, status) {
                            //这里有数据
                            var content = '';
                            var data = data['comment_list'];
                            for (let i = 0; i < data.length; i++) {
                                content += "<ul><li>";
                                content += "<div style=\"display: flex;width: 100%;\">";
                                content += "<a target=\"_blank\" href=\"\">";
                                content += "<img src=\"" + data[i]['avator'] + "\" style=\"border-radius: 30px; width: 32px;height: 32px\">";
                                content += "</a>";
                                content += "<div class=\"right-detail-comment-relation-inner-box\">";
                                content += "<a target=\"_blank\" href=\"\">" + data[i]['user_name'] + "" + data[i]['nick_name'] + "</a>";
                                content += "<span class=\"right-detail-comment-relation-inner-box-comments\">" + data[i]['contents'] + "</span>";
                                content += "<span class=\"right-detail-comment-relation-inner-box-comment-date\">" + data[i]['create_time'] + "</span>";
                                content += "</div>";
                                content += "</div>";
                                content += "</li></ul>";
                            }
                            if (data.length > 0) {
                                if (false === need_append) {
                                    $('.right-detail-comment-relation-inner').html('');
                                }
                                $(content).prependTo('.right-detail-comment-relation-inner');
                            }
                        });
                }

                function prePage() {
                    var page = $('input[name="currPage"]').val();
                    if (--page == 1) {
                        //设置为不可点击
                        $("#prePage").css("display", "none");
                    }
                    $('input[name="currPage"]').val(page);
                    $("#nextPage").css("display", "block");
                    var url = "{{asset('comment/ajaxByPage')}}" + '/' + (page);
                    refresh_comment(url, false);
                    fillPages();
                }

                function nextPage() {
                    var total = $('input[name="listCount"]').val();
                    var page = $('input[name="currPage"]').val();
                    var maxPage = Math.ceil(total / 10);
                    if (++page >= maxPage) {
                        //设置为不可点击
                        $("#nextPage").css("display", "none");
                    }
                    $("#prePage").css("display", "block");
                    $('input[name="currPage"]').val(page);
                    var url = "{{asset('comment/ajaxByPage')}}" + '/' + page;
                    refresh_comment(url, false);
                    fillPages();
                }
            </script>

            <div class="right-detail-comment-relation-inner">
                @foreach($comment_list as $comment)
                    <ul>
                        <li>
                            <div style="display: flex;width: 100%;">
                                <a target="_blank" href="javascript:void(0)">
                                    <img src="{{$comment->avator}}"
                                         style="border-radius: 30px; width: 32px;height: 32px">
                                </a>
                                <div class="right-detail-comment-relation-inner-box">
                                    <a target="_blank"
                                       href="javascript:void(0)">{{$comment->user_name}} {{$comment->nick_name}}</a>
                                    <span class="right-detail-comment-relation-inner-box-comments">{{$comment->contents}}</span>
                                    <span class="right-detail-comment-relation-inner-box-comment-date">{{$comment->create_time}}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
            <div class="comment-pagination">
                <ul>
                    <input type="hidden" name="currPage" value="1"/>
                    <input type="hidden" name="listCount" value="{{$comment_total}}"/>
                    <li><a id="countPages">共n页>>当前m页</a></li>
                    <li>
                        <a href="javascript:void(0)" onclick="prePage()" id="prePage"
                           style="display: none">上一页</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="nextPage()" id="nextPage">下一页</a>
                    </li>
                </ul>
            </div>

        </div>

        <!--相关推荐-->
        <div class="right-detail-recommendation">
            <span><h3>相关推荐</h3></span>
            @foreach ($articles as $article)
                <div class="right-detail-recommendation-inner">
                    <p><a href="{{asset('detail')}}/{{$article->id}}" target="">{{$article->name}}</a></p>
                </div>
            @endforeach
        </div>
    </div>

@endsection

<!--底部-->
@section('app_bottom')
    @parent
@endsection