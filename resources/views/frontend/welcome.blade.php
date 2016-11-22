@extends('frontend.layouts.master')

@section('styles')
<style type="text/css">
	.masthead.segment {
		min-height: 700px;
		padding: 1em 0em;
	}
</style>
@endsection

@section('get-start')
	<div class="ui text container">
		<h1 class="ui inverted header">
			成为一名工匠级的WEB开发工程师
		</h1>
		<h2>Just Do it.</h2>
		<div class="ui huge teal button"><a class="ui disable" href="{{ url('/register') }}"> 马上加入 </a><i class="right arrow icon"></i></div>
	</div>
@endsection

@section('content')
	<div class="ui center aligned basic raised segment">
		<h1>持续更新</h1>
		<h4 class="ui grey header">学习是一个持续的过程</h4>
	</div>

	<div class="ui container">
		@include('frontend.layouts.partials.course_list')
	</div>

	<div class="ui center aligned header basic segment">
		<h1>构建知识框架</h1>
		<h4 class="ui grey header">为您提供了一套不断更新的 Web 设计与开发的知识框架。使用这个知识框架，你可以实践自己的想法，做出你想要的网站或应用。</h4>
	</div>

	<div class="ui container">
		<div class="ui four stackable cards">
			<a class="card"  href="{{ url('course/backend') }}">
				<div class="content">
					<div class="center aligned header">
						<i class="huge orange terminal icon"></i>
						<p>后端</p>
					</div>
					<div class="description">
						<p>开发网站用到的后端,比如PHP框架, 数据库等</p>
					</div>
				</div>
			</a>
			<a class="card"  href="{{ url('course/service') }}">
				<div class="content">
					<div class="center aligned header">
						<i class="huge green server icon"></i>
						<p>服务</p>
					</div>
					<div class="description">
						<p>在开发网站的时候,用到的一些基础服务, 如LNMP环境, Redis服务, 消息服务等</p>
					</div>
				</div>
			</a>

			<a class="card" href="{{ url('course/frontend') }}">
				<div class="content">
					<div class="center aligned header">
						<i class="huge tv icon"></i>
						<p>前端</p>
					</div>
					<div class="description">
						<p>网站前端相关的一些框架, 比如UI框架, JS框架</p>
					</div>
				</div>
			</a>
			<a class="card"  href="{{ url('course/tools') }}">
				<div class="content">
					<div class="center aligned header">
						<i class="huge brown setting icon"></i>
						<p>工具</p>
					</div>
					<div class="description">
						<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
					</div>
				</div>
			</a>
		</div>
	</div>

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