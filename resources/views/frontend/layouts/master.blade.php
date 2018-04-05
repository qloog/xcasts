<!--todo: 重构首页，支持mobile-->
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="baidu-site-verification" content="O7ZZibnsTP" />

    <!-- Site Properties -->
    <title>@yield('title') - PHPCasts</title>
    <meta name="author" content="PHPCasts" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('semantic/dist/semantic.min.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/app.min.css') }}">
    <link rel="shortcut icon" href="{{ cdn('/favicon.png') }}"/>
    <style type="text/css">
        a {
            color: #00B5AD;
        }
        .hidden.menu {
            display: none;
        }

        .masthead.segment {
            @if(Request::is('/'))
            min-height: 700px;
            @endif
            padding: 0em;
        }
        .masthead .logo.item img {
            margin-right: 1em;
        }
        .masthead .ui.menu .ui.button {
            margin-left: 0.5em;
        }
        .masthead h1.ui.header {
            margin-top: 1.5em;
            margin-bottom: 0em;
            font-size: 4em;
            font-weight: normal;
        }
        .masthead h2 {
            font-size: 1.7em;
            font-weight: normal;
        }

        .ui.vertical.stripe {
            padding: 7em 0em;
        }
        .ui.vertical.stripe h3 {
            font-size: 2.2em;
        }
        .ui.vertical.stripe .button + h3,
        .ui.vertical.stripe p + h3 {
            margin-top: 3em;
        }
        .ui.vertical.stripe .floated.image {
            clear: both;
        }
        .ui.vertical.stripe p {
            font-size: 1.22em;
            opacity: 0.65;
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
        .footer .list .item {
            font-weight: 500;
            font-size: 14px;
            height: 43px;
            line-height: 43px;
        }
        .footer .column .header {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.502);
            font-weight: 400;
        }

        .footer .back-to-top {
            background-color: #00B5AD;
            box-shadow: inset 0 1px 0 0 hsla(0,0%,100%,.3),0 1px 2px rgba(0,0,0,.3);
            text-shadow: 0 1px 1px rgba(0,0,0,.2);
            display: block;
            font-size: 16px;
            height: auto;
            line-height: 24px;
            margin: 15px;
            padding: 20px;
            text-align: center;
            position: fixed;
            right: 40px;
            bottom: 60px;
            width: 36px;
            border-radius: 2px;
            z-index: 10;
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
                @if(Request::is('/'))
                    min-height: 350px;
                @endif
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
    @yield('styles')
</head>
<body>
    <!-- Following Menu -->
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            @include('frontend.layouts.partials.menu')
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar menu">
        @include('frontend.layouts.partials.menu')
    </div>

    <div class="pusher">
        <!-- Site content !-->

        <div class="ui inverted vertical masthead center aligned segment">
            <div class="ui container">
                <div class="ui huge secondary inverted menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    @include('frontend.layouts.partials.menu')
                </div>
            </div>

            @if(Request::is('/'))
                @yield('get-start')
            @endif
        </div>

        @if (count($errors) > 0)
            <div class="ui container red message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('flash::message')

        @yield('content')

        <!-- Footer -->
        @include('frontend.layouts.partials.footer')
    </div>

    <script src="{{ elixir('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('semantic/dist/components/visibility.js') }}"></script>
    <script src="{{ asset('semantic/dist/components/sidebar.js') }}"></script>
    <script src="{{ asset('semantic/dist/components/transition.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //scroll to top
            $('.back-to-top').click(function(){
                $('html, body').animate({scrollTop : 0}, 700);
                return false;
            });

			// fix menu when passed
			$('.masthead').visibility({
				once: false,
				onBottomPassed: function() {
					$('.fixed.menu').transition('fade in');
				},
				onBottomPassedReverse: function() {
					$('.fixed.menu').transition('fade out');
				}
			});
			// create sidebar and attach to menu open
			$('.ui.sidebar').sidebar('attach events', '.toc.item');
        });
    </script>
    <!-- baidu tongij -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?2bebd2fc54ce1a6238c5158d55bf33af";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    @yield('scripts')
</body>
</html>
