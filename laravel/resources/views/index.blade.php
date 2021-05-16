@extends('app')
@section('main_title', '我的博客')
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
        <div class="right-banner">
            <span>
                <input type="checkbox">只看原创
            </span>
            <div class="banner-right">
                <span>排序:&nbsp;</span>
                <a href="" style="color: #ca0c16">默认</a>
                <a href="">按更新时间</a>
                <a href="">按访问量</a>
            </div>
        </div>
        @foreach ($titles as $title)
            <div class="right-div">
                <h4 class="right-h4">
                    <a href="{{asset('detail')}}/{{$title->id}}" target="">{{$title->title}}</a>
                </h4>
                <p class="right-content">
                    <a href="index.html">{{$title->sub_title}}</a>
                </p>
                <div class="right-comment">
                    <span>{{$title->created_at}}</span>
                    <span>阅读数：7 </span>
                    <span>评论数：0</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection