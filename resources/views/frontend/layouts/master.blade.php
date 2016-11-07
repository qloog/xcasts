
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Homepage - Semantic</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/dist/semantic.min.css') }}">
    @yield('styles')
</head>
<body>
    <div class="ui inverted vertical masthead center aligned segment">
        @include('frontend.layouts.partials.menu')

        @yield('get-start')
    </div>

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.partials.footer')

<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('semantic/dist/semantic.min.js') }}"></script>
@yield('scripts')
</body>
</html>
