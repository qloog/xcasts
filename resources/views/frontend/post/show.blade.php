@extends('frontend.layouts.master')

@section('title')
    {{ $post->title }} - 博客
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/css/share.min.css">
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments {
            max-width: 100% !important
        }

        #toc a {
            font-size: 14px;
        }

        #toc a .nav_item {
            padding: 2px;
        }
        .current {
            color: white;
            background-color: #00B5AD;
        }
    </style>
@endsection

@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row">
            <div class="eleven wide column">
                <div class="ui segment">
                    <div class="ui large divided relaxed list">
                    <div class="ui divided items" id="post-body">
                        <div class="item">
                            <div class="content">
                                <a class="header"
                                   href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                <div class="meta">
                                    <p class="cinema">发布时间：{{ $post->created_at }}</p>
                                    <p class="cinema">更新时间：{{ $post->updated_at }}</p>
                                    <span class="cinema">阅读数：{{ $post->view_count }}</span>
                                </div>
                                <div class="description markdown-body">
                                    <div class="ui hidden divider"></div>
                                    {!! $post->content !!}
                                    <div class="ui hidden divider"></div>
                                </div>
                            </div>
                        </div>

                        <!--social share bar-->
                        <div class="social-share"></div>
                    </div>
                </div>
                </div>
                <div class="ui comments segment">
                    <h3 class="ui dividing header">发表评论</h3>
                    <form class="ui reply form" method="post" action="{{ route('comment.store') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="type" value="blog">
                        <input type="hidden" name="relation_id" value="{{ $post->id }}" >
                        <input type="hidden" name="slug" value="{{ $post->slug }}" >
                        <div class="@if(!Auth::check()) disabled field @endif">
                            <textarea name="content" id="reply_content" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
                        </div>
                        <button class="ui primary submit labeled icon button @if(!Auth::check()) disabled field @endif" type="submit"><i class="icon edit"></i>回复</button>
                    </form>
                    @foreach($comments as $comment)
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{ cdn($comment->user->avatar) }}">
                            </a>
                            <div class="content">
                                <a class="author">{{ $comment->user->name }}</a>
                                <div class="metadata">
                                    <div class="date">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="text markdown-body">
                                    <p>{!! $comment->content !!}</p>
                                </div>
                                <div class="actions">
                                    <a class="reply" href="javascript:void(0)" onclick="reply_vote({{ $comment->id }})">
                                        <i class="thumbs outline up icon"></i>赞(<span id="vote_count_{{ $comment->id }}">{{ $comment->vote_count }}</span>)
                                    </a>
                                    <a class="reply" href="javascript:void(0)" onclick="reply('{{ $comment->user->name }}')">
                                        <i class="reply icon"></i>回复
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="five wide column">
                <div class="ui large middle aligned divided relaxed list padded segment">
                    <div class="ui fixed top sticky">
                        <h4 class="ui header">目 录</h4>
                        <div class="ui vertical following fluid accordion text menu">
                            <div class="item">
                                <div class="content menu active" id="toc"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/js/social-share.min.js"></script>

    <script type="text/javascript">
        $('.ui.sticky')
                .sticky({
                    offset: 30,
                    context: '#post-body'
                })
        ;
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".markdown-body").find("h1,h2,h3,h4,h5,h6").each(function(i,item){
                var tag = $(item).get(0).tagName.toLowerCase(); // h1,h2...

                $(item).attr("id","wow"+i);
                $(item).addClass("wow_head");
                $("#toc").append('<a class="item nav_item item_'+tag+'" href="#wow'+i+'">'+$(this).text()+'</a></br>');

                $(".item_h2").css("margin-left",'0rem');
                $(".item_h3").css("margin-left",'2rem');
                $(".item_h4").css("margin-left",'4rem');
                $(".item_h5").css("margin-left",'6rem');
                $(".item_h6").css("margin-left",'8rem');
            });

            $(".nav_item").click(function(){
                $("html,body").animate({scrollTop: $($(this).attr("href")).offset().top}, 500);
            });

            var headerNavs = $(".nav_item");
            var headerTops = [];
            $(".wow_head").each(function(i, n){
                headerTops.push($(n).offset().top);
            });
            $(window).scroll(function(){
                var scrollTop = $(window).scrollTop();
                $.each(headerTops, function(i, n){
                    var distance = n - scrollTop;
                    if(distance >= 0) {
                        console.log(headerNavs[i]);
                        $(".nav_item").css({"color":"","background-color": "","padding":""});
                        $(headerNavs[i]).css({"color":"white","background-color": "#00B5AD","padding":"3px"});

//                        $(".nav_item").removeClass("current");
//                        $(headerNavs[i]).addClass("current");
                        return false;
                    }
                });
            });
        });

        function reply_vote(comment_id) {
            console.log(comment_id);
            $.ajax({
                type: 'POST',
                url: '/comment/' + comment_id + '/vote',
                data: {'_token': '{{ csrf_token() }}','_method':'post'},
                dataType:'json',
                success: function (ret) {
                    console.log(ret);
                    if (ret.code == 200 ) {
                        $('#vote_count_' + comment_id).text(ret.count);
                    }
                }
            });
        }

        function reply(username) {
            var replyContent = $('#reply_content');
            var oldContent = replyContent.val();
            var lastAtUser = "@" + username + " ";
            var newContent = '';
            if (oldContent.length > 0) {
                if (oldContent != lastAtUser) {
                    newContent = oldContent + "\n" + lastAtUser;
                }
            } else {
                newContent = lastAtUser;
            }

            replyContent.focus();
            replyContent.val(newContent);
        }
    </script>
@endsection