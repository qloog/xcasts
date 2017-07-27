@extends('frontend.layouts.master')

@section('content')
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui positive message">
            <div class="header">
                感谢您的反馈^_^
            </div>
            <p><b><a href="{{ route('welcome') }}">回到首页</a></b></p>
            <div class="ui hidden divider"></div>
        </div>
@endsection