@extends('frontend.layouts.master')

@section('styles')
	<style type="text/css">
		.hidden.menu {
			display: none;
		}

		.masthead.segment {
			min-height: 700px;
			padding: 1em 0em;
		}
		.masthead .logo.item img {
			margin-right: 1em;
		}
		.masthead .ui.menu .ui.button {
			margin-left: 0.5em;
		}
		.masthead h1.ui.header {
			margin-top: 3em;
			margin-bottom: 0em;
			font-size: 4em;
			font-weight: normal;
		}
		.masthead h2 {
			font-size: 1.7em;
			font-weight: normal;
		}

		.ui.vertical.stripe {
			padding: 8em 0em;
		}
		.ui.vertical.stripe h3 {
			font-size: 2em;
		}
		.ui.vertical.stripe .button + h3,
		.ui.vertical.stripe p + h3 {
			margin-top: 3em;
		}
		.ui.vertical.stripe .floated.image {
			clear: both;
		}
		.ui.vertical.stripe p {
			font-size: 1.33em;
		}
		.ui.vertical.stripe .horizontal.divider {
			margin: 3em 0em;
		}

		.quote.stripe.segment {
			padding: 0em;
		}
		.quote.stripe.segment .grid .column {
			padding-top: 5em;
			padding-bottom: 5em;
		}

		.footer.segment {
			padding: 5em 0em;
		}

		.secondary.pointing.menu .toc.item {
			display: none;
		}

		@media only screen and (max-width: 700px) {
			.ui.fixed.menu {
				display: none !important;
			}
			.secondary.pointing.menu .item,
			.secondary.pointing.menu .menu {
				display: none;
			}
			.secondary.pointing.menu .toc.item {
				display: block;
			}
			.masthead.segment {
				min-height: 350px;
			}
			.masthead h1.ui.header {
				font-size: 2em;
				margin-top: 1.5em;
			}
			.masthead h2 {
				margin-top: 0.5em;
				font-size: 1.5em;
			}
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
		<div class="ui four column stackable grid">
			<div class="column">
				<div class="ui link card">
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
			</div>
			<div class="column">
				<div class="ui link card">
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
			</div>
			<div class="column">
				<div class="ui link card">
					<div class="content">
						<div class="center aligned header">
							<i class="huge code icon"></i>
							<p>前端</p>
						</div>
						<div class="description">
							<p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
						</div>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="ui link card">
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