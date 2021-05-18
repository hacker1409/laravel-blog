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
                <a href="{{asset('form/show')}}"
                   style="font-size:1rem; margin-left: 0.5rem;color: #ffffff;background: #d05f2d;border-radius: 20%">新增文章</a>
            </span>
            <div class="banner-right">
                <span>排序:&nbsp;</span>
                <a href="{{asset('/')}}/id" style="color: #ca0c16" id="default_order">默认</a>
                <a href="{{asset('/')}}/update_time" id="time_order">按更新时间</a>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#time_order").click(function () {
                    $("#time_order").css("color", "red");
                    $("#default_order").css("color", "blue");
                });
            });
        </script>

        @foreach ($articles as $article)
            <div class="right-div">
                <h4 class="right-h4">
                    <a href="{{asset('detail')}}/{{$article->id}}" target="_blank">{{$article->name}}</a>
                </h4>
                <p class="right-content">
                    <a href="{{asset('detail')}}/{{$article->id}}" target="_blank">{{$article->summary}}</a>
                </p>
                <div class="right-comment">
                    <span>{{$article->create_time}}</span>
                    <span>阅读数：7 </span>
                    <span>评论数：0</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection