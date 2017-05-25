@extends('frontend.layouts.master')

@section('title')
    修改头像
@endsection

@section('styles')
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@stop

@section('content')
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui grid">
                    <div class="four wide column">
                        @include('frontend.user.setting_nav')
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <h2 class="ui header">修改头像</h2>
                            <div class="ui divider"></div>
                            <form class="ui form" method="post" action="{{ route('user.avatar.update', Auth()->id()) }}" enctype="multipart/form-data" accept-charset="utf-8">
                                <input type="hidden" name="_method" value="PUT">
                                {!! csrf_field() !!}
                                <div class="field">
                                    <label>请选择图片</label>
                                    <img src="{{ $user->avatar }}" />
                                    <input type="file" name="avatar" />
                                </div>
                                <button class="ui teal center aligned button" type="submit">上传头像</button>
                            </form>
                        </div>
                    </div>
                </div>
        <div class="ui hidden divider"></div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('.button').popup();
        });
    </script>
@endsection