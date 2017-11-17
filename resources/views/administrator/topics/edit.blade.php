@extends('administrator.layouts.app')
@section('title', 'Topics | Edit')
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
                                <a href="{{ route('topics.index') }}">Topics</a>
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
                            <form action="{{ route('topics.update', $topic->id) }}" method="POST" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label>Category</label>
                                        <select class="form-control m-select2" id="m_select2_1" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $topic->category_id)
                                                        selected 
                                                    @endif
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Name</label>
                                        <input type="text" class="form-control m-input" name="name" placeholder="Enter name" value="{{ $topic->name }}" required autocomplete="off">
                                        @if ($errors->has('name'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Overview</label>
                                        <input type="text" class="form-control m-input" name="overview" placeholder="Enter overview" value="{{ $topic->overview }}" required autocomplete="off">
                                        @if ($errors->has('overview'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('overview') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Image</label>
                                        <input type="file" class="d-block" name="image" style="outline: none">
                                        <img src="{{ $topic->pathImage() }}" class="mt-3">
                                        @if ($errors->has('image'))
                                            <span class="m-form__help m--font-danger">{{ $errors->first('image') }}</span>
                                        @endif
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