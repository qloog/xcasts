@extends('frontend.layouts.master')

@section('title')
	PHP Yaf Laravel 视频教程
@endsection

@section('keywords')
    PHPCasts,Yaf 视频,Laravel 视频, Yaf 教程, Laravel 教程
@endsection

@section('get-start')
	<div class="ui text container">
		<h1 class="ui inverted header">
			Become a modern web development engineer.
		</h1>
		<h2>Just Do it.</h2>
		<!-- todo: check is vip-->
		@if(Auth::id())
			<div class="ui huge teal button" href="{{ url('/vip') }}">马上观看所有视频<i class="right arrow icon"></i></div>
		@else
			<div class="ui huge teal button" href="{{ url('register') }}">马上加入<i class="right arrow icon"></i></div>
		@endif
	</div>
@endsection

@section('content')
	<div class="ui vertical stripe segment">
		<div class="ui middle aligned stackable grid container">
			<div class="row">
				<div class="center aligned column">
					<h3 class="ui header">持续更新</h3>
					<p>享受编程和技术所带来的乐趣</p>
				</div>
			</div>
			@include('frontend.layouts.partials.course_list')
		</div>
	</div>

	<div class="ui vertical stripe segment">
		@include('frontend.layouts.partials.path_list')
	</div>
@endsection