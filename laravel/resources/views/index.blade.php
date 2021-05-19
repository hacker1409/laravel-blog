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
                <a href="{{asset('/')}}id" style="color: #ca0c16" id="default_order">默认</a>
                <a href="{{asset('/')}}update_time" id="time_order">按更新时间</a>
            </div>
        </div>
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
        <input type="hidden" name="articleTotal" value="{{$total}}"/>
        <input type="hidden" name="articleCurrPage" value="1"/>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#time_order").click(function () {
                $("#time_order").css("color", "red");
                $("#default_order").css("color", "blue");
            });

            $(".right").scroll(function () {
                var totalHeight = $(this).height();
                scrollHight = $(this)[0].scrollHeight;
                currScrollHeight = $(this)[0].scrollTop;
                console.log(currScrollHeight);
                if (currScrollHeight + totalHeight >= scrollHight) {
                    //ajax追加内容
                    refresh_article();

                }
            });
        });

        // ajax获取文章列表
        //拉取数据
        function refresh_article() {
            var total = $('input[name="articleTotal"]').val();
            var page = $('input[name="articleCurrPage"]').val();
            var maxPage = Math.ceil(total / 15);
            if (++page > maxPage) {
                alert("亲，已经被你看完了");
                return;
            }

            var url = "{{asset('article/ajaxShow')}}" + '/' + page;
            $.get(url,
                {},
                function (data, status) {
                    console.log(data);
                    if (data.length <= 0) {
                        alert("亲，已经被你看完了");
                    }
                    //这里有数据
                    var content = '';
                    data = data['articles'];
                    total = data['total'];
                    for (let i = 0; i < data.length; i++) {
                        content += "<div class=\"right-div\">";
                        content += "<h4 class=\"right-h4\">";
                        content += "<a href=\"{{asset('detail')}}/" + data[i]['id'] + "\" target=\"_blank\">" + data[i]['name'] + "</a>";
                        content += "</h4>";
                        content += " <p class=\"right-content\">";
                        content += "<a href=\"{{asset('detail')}}/" + data[i]['id'] + "\" target=\"_blank\">" + data[i]['summary'] + "</a>";
                        content += "</p>";
                        content += "<a target=\"_blank\" href=\"\">" + data[i]['user_name'] + "" + data[i]['nick_name'] + "</a>";
                        content += "<div class=\"right-comment\">";
                        content += "<span>" + data[i]['create_time'] + "</span>";
                        content += "<span>阅读数：7</span>";
                        content += "<span>评论数：1</span>";
                        content += "</div>";
                        content += "</div>";

                    }
                    $(content).appendTo('.right');
                    $('input[name="articleCurrPage"]').val(page);
                });
        }

    </script>
@endsection