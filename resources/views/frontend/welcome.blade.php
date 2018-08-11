@extends('frontend.layouts.master')

@section('title')
	PHP Yaf Laravel Vue Phalcon 视频教程
@endsection

@section('styles')
<style>
	.cover-layer{
		height: 46.35em;
		width: 100%;
		background: #000;
		position: absolute;
		top: 50px;
		opacity: 0.95;
		z-index: 10;
		left: 0;
	}
	.glass {
		z-index: -1;
		width: 100%;
		height: auto;
		filter: blur(2px);
		-webkit-filter: blur(2px);
		-moz-filter: blur(2px);
		-ms-filter: blur(2px);
		-o-filter: blur(2px);
	}
</style>
@endsection

@section('keywords', 'PHPCasts, 视频教程, Yaf视频,Laravel视频, Yaf教程, Laravel教程')

@section('get-start')
	<div class="ui fluid container">
{{--	<video src="{{ cdn('/bg.mp4') }}" class="glass" poster="file:///Users/qloog/Downloads/500302822.jpg" autoplay="" loop="" data-video="0"></video>--}}
	</div>
	<div class="cover-layer" style="background: url('{{ thumb('/homepage-background.jpg', 1400, 650) }}') no-repeat center">
		<div class="ui text container">
			<h1 class="ui inverted header">
				{{--Programming by Doing--}}
				向终生Coding者致敬
			</h1>
			<h2>“学习的最好方法就是做” - P.R. Halmos</h2>
		</div>
		<div class="ui text container">
			<!-- todo: check is vip-->
			<h1 class="ui inverted header">
			@if(Auth::id())
				<a class="ui huge teal button" href="{{ url('/vip') }}">马上观看所有视频<i class="right arrow icon"></i></a>
			@else
				<a class="ui huge teal button" href="{{ url('register') }}">马上观看<i class="right arrow icon"></i></a>
			@endif
			</h1>
		</div>
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

	<div class="ui vertical stripe segment" @if(Request::is('/')) style="background-color: #fff;" @endif>
		@include('frontend.layouts.partials.path_list')
	</div>

	<div class="ui vertical stripe secondary segment">
		@include('frontend.layouts.partials.stat')
	</div>

	<div class="ui vertical stripe segment">
		@include('frontend.layouts.partials.subscribe')
	</div>

@endsection