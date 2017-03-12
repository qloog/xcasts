@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                @include('frontend.layouts.partials.path_list')
            </div>
        </div>
        <div class="row"></div>
    </div>
@endsection