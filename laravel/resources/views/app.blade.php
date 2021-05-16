<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="HandheldFriendly" content="true">
    <title> @yield('main_title')</title>
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript">
        $(document).scroll(function () {
            var scroH = $(document).scrollTop();  //滚动高度
            var viewH = $(window).height();  //可见高度
            if (viewH - scroH <= 0) {
                // alert("滚动到底部事件触发");
            }
        })
    </script>
</head>

<body>
<div class="container">
    <!--头部-->
    @section('app_header')
        <div class="header">.
            <div class="header_left">
                <a href="/">hacker_wtm的博客</a>
                <p class="header_left_desc">我是一个爱学习的菜鸟</p>
            </div>
            <div class="header_right">
                <a href="index.html">RSS订阅</a>
                <a href="index.html">管理博客</a>
            </div>
        </div>
    @show

<!--左侧-->
    @section('app_left')
        <div class="left">
            <!--个人信息-->
            <h6>个人资料</h6>
            <div class="left-first">
                <img src="{{ asset('images/header.png') }}">
                <span class="left-first-uname">Hacker_wtm (这人很懒，什么也没留下)</span>
            </div>
            <!--原创-->
            <div class="left-second">
                <dl>
                    <a href="{{url('user/show')}}">原创</a>
                    <a href="">10</a>
                </dl>

                <dl>
                    <dt>粉丝</dt>
                    <span>250</span>
                </dl>

                <dl>
                    <dt>喜欢</dt>
                    <span>56</span>
                </dl>

                <dl>
                    <dt>评论</dt>
                    <span>31</span>
                </dl>
            </div>
            <!--等级，积分-->
            <div class="left-third">
                <div class="third-div">
                    <span>等级：12</span>
                    <span>积分：66</span>
                </div>
                <div class="third-div">
                    <span>访问：12</span>
                    <span>排名：6600+</span>
                </div>
            </div>
            <!--轮播图-->
            <div class="left-four">
                <img src="{{ asset('images/header.png') }}">
            </div>
            <!--归档-->
            <div class=" left-guidang">
                <h6>归档</h6>
                <div class="left-guidang-div">
                    <a href="index.html">2018-09-09</a>
                    <span>1篇</span>
                </div>

                <div class="left-guidang-div">
                    <a href="index.html">2018-09-09</a>
                    <span>1篇</span>
                </div>

                <div class="left-guidang-div">
                    <a href="index.html">2018-09-09</a>
                    <span>1篇</span>
                </div>

                <div class="left-guidang-div">
                    <a href="index.html">2018-09-09</a>
                    <span>1篇</span>
                </div>

            </div>

            <div class="left-hot">
                <h6>热门文章</h6>
                <div class="left-hot-div">
                    <a href="index.html">php学习路线图</a>
                    <span>阅读量: 558</span>
                </div>

                <div class="left-hot-div">
                    <a href="index.html">php学习路线图</a>
                    <span>阅读量: 558</span>
                </div>

                <div class="left-hot-div">
                    <a href="index.html">php学习路线图</a>
                    <span>阅读量: 558</span>
                </div>

                <div class="left-hot-div">
                    <a href="index.html">php学习路线图</a>
                    <span>阅读量: 558</span>
                </div>

            </div>

            <div class="left-four">
                <img src="{{ asset('images/header.png') }}">
            </div>
        </div>
    @show

<!--右侧-->
    @section('app_right')
    @show

<!--底部-->
    @section('app_bottom')
        <div class="footer-top">
            <p><a>Copyright © lyahcker 2020-2021 All Rights Reserved</a></p>
            <p><a>版权所有：tmwen</a></p>
            <p><a>联系地址：深圳市南山区</a></p>
            <p><a>联系电话：0775-12345678 邮箱: lyhacker_wtm@163.com</a></p>
            <p><a>粤ICP证1000xx号</a></p>
            <p><a>粤网文【2019】0000-000号</a></p>
            <p><a>粤公网安备XXXXXXXXXXXXXX号</a></p>
        </div>
    @show
</div>

</body>
</html>