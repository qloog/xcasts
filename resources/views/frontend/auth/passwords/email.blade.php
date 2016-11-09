@extends('frontend.layouts.master')

@section('content')
    @if (session('status'))
        <div class="ui success message transition container">
            <i class="close icon"></i>
            <div class="header">{{ session('status') }} </div>
            {{--<p>That offer has expired </p>--}}
        </div>
    @endif

    <form class="ui large form container" method="POST" action="{{ url('/password/email') }}">
        <div class="ui stacked segment">
            <h3 class="ui blue block header">发送重置密码链接</h3>
            {{ csrf_field() }}

            <div class="field">
                <label>邮箱</label>
                <input type="text" name="email" placeholder="邮箱地址" value="{{ $email or old('email') }}" required autofocus>
            </div>
            <button class="ui button" type="submit">发送</button>
        </div>
    </form>
    <div class="striped"></div>
@endsection

<!-- Main Content -->
@section('content111')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
