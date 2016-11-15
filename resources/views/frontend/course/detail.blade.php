@extends('frontend.layouts.master')

@section('content')

    <!-- banner -->
    <div class="ui grid" style="height:260px; background: #393E46;">
        <div class="ui container two columns grid">
            <div class="column" style="color: #ffffff;margin-top: 40px;">
                <h3>{{ $course->name }}</h3>
                <div class="label">{{ $course->description }}</div>
            </div>
            <div class="column"></div>
        </div>
    </div>

    <!-- episode list-->
    <div class="ui page grid" >
        <div class="two column row" style="background-color: #f5f5f1;margin-top: 20px;">
            <div class="column">
                <table class="ui single line selectable  table">
                    <tbody>
                    <tr>
                        <td>John</td>
                        <td>No Action</td>
                        <td class="ui right aligned">None</td>
                        <td class="ui center aligned">None</td>
                    </tr>
                    <tr>
                        <td>Jamie</td>
                        <td>None</td>
                        <td class="ui right aligned">Approved</td>
                        <td class="ui center aligned">Requires call</td>
                    </tr>
                    <tr>
                        <td>Jamie</td>
                        <td>None</td>
                        <td class="ui right aligned">Approved</td>
                        <td class="ui center aligned">Requires call</td>
                    </tr>
                    <tr>
                        <td>Jamie</td>
                        <td>None</td>
                        <td class="ui right aligned">Approved</td>
                        <td class="ui center aligned">Requires call</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="column"></div>
        </div>
    </div>

@endsection