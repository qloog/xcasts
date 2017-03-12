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
                            <h1 class="page-header">一对一服务</h1>
                            <div id="node-417" class="node node-page view-mode-full clearfix" about="/terms" typeof="foaf:Document">
                                <span property="dc:title" content="服务条款" class="rdf-meta element-hidden"></span><span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span><div class="node-content">
                                    <div class="content">
                                        <h3>我们可以提供以下服务</h3>
                                        <p>1. WEB开发入门指导 </p>
                                        <p>2. PHP快速从入门到实战 </p>
                                        <p>3. 数据库从入门到实践 </p>
                                        <p>4. 任何web开发相关的问题都可以交流 </p>
                                    </div>
                                </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
        });
    </script>
@endsection