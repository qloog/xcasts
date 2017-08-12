@extends('frontend.layouts.master')

@section('content')
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui form">
            <form method="POST" action="{{ route('feedback.store') }}">
                {{ csrf_field() }}
                <div class="field">
                    <label>内容</label>
                    <textarea name="content" rows="20" placeholder="请输入需要反馈的具体内容" required></textarea>
                </div>
                <button class="ui button" type="submit">提交反馈</button>
            </form>
        </div>
        <div class="ui hidden divider"></div>
    </div>
@endsection