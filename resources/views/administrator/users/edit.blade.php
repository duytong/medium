@extends('administrator.layouts.app')
@section('title', 'Users | Edit')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">Users</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            @if (session('success'))
                                <div id="toast-container" class="toast-top-right">
                                    <div class="toast toast-success" aria-live="polite">
                                        <div class="toast-title">Success!</div>
                                        <div class="toast-message">{{ session('success') }}</div>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('users.update', $user->id) }}" method="POST" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label>Name</label>
                                        <input type="text" class="form-control m-input" name="name" placeholder="Enter name" value="{{ $user->name }}" required autofocus autocomplete="off">
                                        @if ($errors->has('name'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Username</label>
                                        <input type="text" class="form-control m-input" name="username" placeholder="Enter username" value="{{ $user->username }}" required autocomplete="off">
                                        @if ($errors->has('username'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Email</label>
                                        <input type="email" class="form-control m-input" name="email" placeholder="Enter email" value="{{ $user->email }}" required autocomplete="off">
                                        @if ($errors->has('email'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Password</label>
                                        <input type="password" class="form-control m-input" name="password" placeholder="Leave blank if don't change">
                                        @if ($errors->has('password'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Confirm password</label>
                                        <input type="password" class="form-control m-input" name="confirm_password" placeholder="Matches the password">
                                        @if ($errors->has('confirm_password'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('confirm_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Avatar</label>
                                        <input type="file" class="d-block" name="avatar" style="outline: none">
                                        <img src="{{ $user->pathImage() }}" class="mt-3">
                                        @if ($errors->has('avatar'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Role</label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--state-primary">
                                                <input type="radio" name="role" value="0"
                                                    @if ($user->role == 0)
                                                        checked 
                                                    @endif>
                                                User
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--state-danger">
                                                <input type="radio" name="role" value="1"
                                                    @if ($user->role == 1)
                                                        checked 
                                                    @endif>
                                                Adminstrator
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit float-right">
                                    <div class="m-form__actions">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection