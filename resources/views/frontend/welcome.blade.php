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
			Imagine-a-Company
		</h1>
		<h2>Do whatever you want when you want to.</h2>
		<div class="ui huge primary button">Get Started <i class="right arrow icon"></i></div>
	</div>
@endsection

@section('content')
	<div class="ui center aligned header basic raised segment">
		<h1 class="ui center aligned">Examples of UI that inherit border styles</h1>
	</div>

	<div class="ui container">
		<div class="ui three stackable cards">

			@for($i=0; $i<8; $i++)
				<div class="ui raised link card">
					<a class="image" href="#link">
						<img src="http://semantic-ui.com/images/avatar/large/steve.jpg" style="width: 300px; height: 200px;"/>
					</a>
					<div class="content">
						<a class="header" href="#link">Steve Jobes</a>
						<div class="meta">
							<a class="time">Last Seen 2 days ago</a>
							<span class="right floated">3 videos</span>
						</div>
					</div>
				</div>
			@endfor
		</div>
	</div>

	<div class="ui center aligned header basic segment">
		<h1 class="ui aligned">Examples of UI that inherit border styles</h1>
	</div>

	<div class="ui center aligned basic segment">
		<h4>Examples of UI that inherit border styles</h4>
	</div>

	<div class="ui center aligned basic segment">
		<h3>Examples of UI that inherit border styles</h3>
	</div>

	<div class="ui container">
		<div class="ui four stackable cards">
			<div class="card">
				<div class="content">
					<div class="center aligned header">
						<i class="huge orange terminal icon"></i>
						<p>后端</p>
					</div>
					<div class="description">
						<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="content">
					<div class="center aligned header">
						<i class="huge green server icon"></i>
						<p>服务</p>
					</div>
					<div class="description">
						<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="content">
					<div class="center aligned header">
						<i class="huge tv icon"></i>
						<p>前端</p>
					</div>
					<div class="description">
						<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="content">
					<div class="center aligned header">
						<i class="huge brown setting icon"></i>
						<p>工具</p>
					</div>
					<div class="description">
						<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
					</div>
				</div>
			</div>
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