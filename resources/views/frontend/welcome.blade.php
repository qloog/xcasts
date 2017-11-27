@extends('frontend.layouts.master')

@section('title')
	PHP Yaf Laravel 视频教程
@endsection

@section('keywords')
    PHPCasts,Yaf 视频,Laravel 视频, Yaf 教程, Laravel 教程
@endsection

@section('styles')
<style type="text/css">
	.masthead.segment {
		min-height: 550px;
		padding: 1em 0em;
	}
</style>
@endsection

@section('get-start')
	<div class="ui container">
		<h1 class="ui inverted header">
			成为一名工匠级的现代化<br>Web Develop Engineer
		</h1>
		<h2>Just Do it.</h2>
		<!-- todo: check is vip-->
		@if(Auth::id())
			<a class="ui huge teal button" href="{{ url('/vip') }}">马上观看所有视频<i class="right arrow icon"></i></a>
		@else
			<a class="ui huge teal button" href="{{ url('register') }}">马上加入<i class="right arrow icon"></i></a>
		@endif
	</div>
@endsection

@section('content')
	<div class="ui center aligned basic raised segment">
		<h1>持续更新</h1>
		<h4 class="ui grey header">享受编程和技术所带来的乐趣</h4>
	</div>

	<div class="ui container">
		@include('frontend.layouts.partials.course_list')
	</div>

	@include('frontend.layouts.partials.path_list')

	<div class="ui divider"></div>
@endsection

@section('scripts')
	<script src="{{ asset('semantic/dist/components/visibility.js') }}"></script>
	<script src="{{ asset('semantic/dist/components/sidebar.js') }}"></script>
	<script src="{{ asset('semantic/dist/components/transition.js') }}"></script>
	<script>
//		$(document).ready(function() {
//			// fix menu when passed
//			$('.masthead').visibility({
//				once: false,
//				onBottomPassed: function() {
//					$('.fixed.menu').transition('fade in');
//				},
//				onBottomPassedReverse: function() {
//					$('.fixed.menu').transition('fade out');
//				}
//			});
//			// create sidebar and attach to menu open
//			$('.ui.sidebar').sidebar('attach events', '.toc.item');
//		});
	</script>
@endsection