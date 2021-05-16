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
                {{$title->title}}
            </span>
        </div>

        <div class="right-detail-title-contents">
            <p>
                <span><pre>{{$title->contents}}</pre></span>
            </p>
            @foreach($title->thumbs as $picture)
                <img src="{{$picture}}"/>
            @endforeach

        </div>
        <div class="right-detail-title-contents-attachement">
            <span>附件:</span>
            @foreach($title->attachments as $attach)
                <a href="{{$attach['url']}}" download="{{$attach['name']}}">{{$attach['name']}}</a>
            @endforeach
        </div>

        <div class="right-detail-title-comment">
            <div class="right-detail-title-comment-keywords">
                <span>副标题 : {{$title->sub_title}}</span>
                <span>关键字 : {{$title->key_words}}</span>
            </div>
            <div class="right-detail-title-comment-read">
                <span>时  间 : {{$title->created_at}}</span>
                <span>阅读数 : 5 </span>
                <span>评论数 : 3</span>
                <span>点赞数 : 4</span>
            </div>
        </div>

        <!--评论相关-->
        <div class="right-detail-comment-relation">
            <span><h3>最新评论</h3></span>
            <div class="right-detail-comment-relation1">
                <p><a href="" target="">2写的不错，继续加油</a></p>
            </div>
            <div class="right-detail-comment-relation1">
                <p><a href="" target="">3写的不错，继续加油</a></p>
            </div>
            <div class="right-detail-comment-relation1">
                <p><a href="" target="">4写的不错，继续加油</a></p>
            </div>
            <div class="right-detail-comment-relation1">
                <p><a href="" target="">good! 写的不错，继续加油</a></p>
            </div>
            <div class="right-detail-comment-relation1">
                <p><a href="" target="">33写的不错，继续加油</a></p>
            </div>
        </div>

        <!--相关推荐-->
        <div class="right-detail-recommendation">
            <span><h3>相关推荐</h3></span>
            @foreach ($titles as $title)
                <div class="right-detail-recommendation-inner">
                    <p><a href="{{asset('detail')}}/{{$title->id}}" target="">{{$title->title}}</a></p>
                </div>
            @endforeach
        </div>
    </div>

@endsection

<!--底部-->
@section('app_bottom')
    @parent
@endsection