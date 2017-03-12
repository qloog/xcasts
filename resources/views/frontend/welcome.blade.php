@extends('frontend.layouts.master')

@section('styles')
<style type="text/css">
	.masthead.segment {
		min-height: 550px;
		padding: 1em 0em;
	}
</style>
@endsection

@section('get-start')
	<div class="ui text container">
		<h1 class="ui inverted header">
			成为一名现代化的Web Develop Engineer
		</h1>
		<h2>Just Do it.</h2>
		<div class="ui huge button">
		@if(Auth::id())
			<a class="ui disable" href="{{ url('/vip') }}"> 马上观看所有视频 </a><i class="right arrow icon"></i>
		@else
			<a class="ui disable" href="{{ url('/register') }}"> 马上加入 </a><i class="right arrow icon"></i>
		@endif
	</div>
	</div>
@endsection

@section('content')
	<div class="ui center aligned basic raised segment">
		<h1>持续更新</h1>
		<h4 class="ui grey header">学习是一个坚持的过程</h4>
	</div>

	<div class="ui container">
		@include('frontend.layouts.partials.series_list')
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