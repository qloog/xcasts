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
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui secondary segment">
                            稍后补充...
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
        });
    </script>
@endsection