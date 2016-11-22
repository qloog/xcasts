@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <div class="ui large middle aligned divided relaxed list">
                            @for($i = 0; $i < 40; $i++)
                            <div class="item">
                                <div class="right floated content">
                                    <div class="ui circular labels">
                                        <a class="ui label">
                                            11
                                        </a>
                                    </div>
                                </div>
                                <img class="ui avatar image" src="{{ asset('/avatars/avatar.png') }}">
                                <div class="content">
                                    <a class="header">Android 6.0， MIUI8，如何修改 MAC 地址？进校园网黑名单了{{ $i }}</a>
                                    <div class="description">

                                        <div class="ui horizontal link list">
                                            <a class="item">
                                                PHP
                                            </a>
                                            <a class="disabled item">
                                                3分钟前
                                            </a>
                                            <a class="disabled item">
                                                最后回复来自:
                                            </a>
                                            <a class="item">
                                                是非得失发
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui card">
                            <div class="image">
                                <img src="/images/avatar2/large/kristy.png">
                            </div>
                            <div class="content">
                                <a class="header">Kristy</a>
                                <div class="meta">
                                    <span class="date">Joined in 2013</span>
                                </div>
                                <div class="description">
                                    Kristy is an art director living in New York.
                                </div>
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="user icon"></i>
                                    22 Friends
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection