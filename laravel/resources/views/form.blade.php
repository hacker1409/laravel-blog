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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div style="float: left;display:flex;flex-direction: column;margin-left: 1rem;">
        <form method="post" id="save_title">
            <p>文章标题: <input type="text" name="title" value=""/></p>
            <p>子标题: <input type="text" name="sub_title" value=""/></p>
            <p>关键字: <input type="text" name="key_words" value="" placeholder="多个以英文;分号分割"/></p>
            <p>缩略图: <input type="text" name="thumbs"/></p>
            <p>附件: <input type="text" name="attachments"/></p>
            <p><textarea placeholder="请在此出写文章主要内容" rows="40" cols="100%" name="contents"></textarea></p>
            <input type="button" value="提交" id="submit_title"/>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#submit_title").click(function () {
                var title = $('input[name="title"]').val();
                var sub_title = $('input[name="title"]').val();
                var key_words = $('input[name="key_words"]').val();
                var contents = $('textarea[name="contents"]').val();
                $.post("{{asset('artitle/save')}}",
                    {
                        title: title,
                        sub_title: sub_title,
                        key_words: key_words,
                        contents: contents,
                    },
                    function (data, status) {
                        if (0 == data.code) {
                            alert('fail')
                        } else {
                            alert('success');
                            window.location.href = "{{asset('/')}}";
                        }
                    });
            });
        });
    </script>
@endsection

<!--底部-->
@section('app_bottom')
    @parent
@endsection