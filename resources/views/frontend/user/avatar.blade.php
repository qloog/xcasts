@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@stop

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="four wide column">
                        @include('frontend.user.left_sidebar')
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <h2 class="ui header">修改头像</h2>
                            <div class="ui divider"></div>
                            <form class="ui form">
                                <div class="field">
                                    <label>请选择图片</label>
                                    <input type="text" name="avatar" />
                                </div>
                                <button class="ui teal center aligned button" type="submit">上传头像</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
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