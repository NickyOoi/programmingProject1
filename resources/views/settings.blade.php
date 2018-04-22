@extends('layouts.app2')
<style>
    .title {
        text-align: center;
    }
    hr { 
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
        width: 75%;
    } 
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Settings') }}</div>

                &nbsp;&nbsp;
                <div class="title">
                    <h4>Change Password</h4>
                    <hr align="center">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="currentPassword" class="col-sm-4 col-form-label text-md-right">{{ __('Current password') }}</label>

                            <div class="col-md-6">
                                <input id="currentPassword" type="password" class="form-control{{ $errors->has('currentPassword') ? ' is-invalid' : '' }}" name="currentPassword" required autofocus>
                            
                                @if ($errors->has('currentPassword'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('currentPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newPassword" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>

                            <div class="col-md-6">
                                <input id="newPassword" type="text" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" name="newPassword" required>
                            </div>
                        </div>

                        &nbsp;&nbsp;
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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