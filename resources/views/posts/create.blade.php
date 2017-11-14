@extends('layouts.app')
@section('title', 'New post - Medium')
@section('content')
    <div class="my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <a href="{{ auth()->user()->path() }}">
                            <img data-src="{{ auth()->user()->pathImage() }}" class="circle img-40 mr-2 lazy" title="{{ auth()->user()->name }}">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="{{ auth()->user()->path() }}" class="text-success" title="{{ auth()->user()->name }}">
                                {{ auth()->user()->name }}
                            </a>
                            <div class="font-size-12">Draft</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select id="topic" class="w-full" name="topic_id">
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->topics->sortBy('name') as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="title" class="form-control px-0 bd-none font-size-40 font-weight-bold text-dark" name="title" placeholder="Title" autofocus autocomplete="off" value="{{ old('title') }}">
                            </div>
                            <textarea class="medium-editor font-serif font-size-20 text-dark" name="body" contenteditable="true" data-placeholder="Tell your post...">{{ old('body') }}</textarea>
                            <div class="form-group">
                                <input name="tags" id="tags">
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center form-group">
                                <div class="mb-2" id="file-name">No file selected (optional)</div>
                                <label for="file-selector" class="btn btn-shadow mb-0">
                                    <input type="file" id="file-selector" class="d-none" name="image">
                                        <i class="fa fa-image mr-2"></i>Upload
                                </label>
                            </div>
                            <input type="hidden" id="post-id" name="post_id">
                            <input type="submit" id="btn-submit" class="btn bg-success btn-shadow float-right" name="publish" value="Publish" data-toggle="tooltip" data-placement="top" title="Publishing will become available after you start writing and select a topic.">
                            @if ($errors->has('image'))
                                <div class="alert alert-bar bd-none text-white card-shadow" role="alert">{{ $errors->first('image') }}</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Search tags
        $(function () {
            var urlSearchTags = window.location.origin + '/search-tags';

            $('#tags').tokenInput(
                urlSearchTags,
                {
                    theme: 'facebook',
                    tokenLimit: 5,
                    allowFreeTagging: true,
                    hintText: false,
                    tokenValue: 'name',
                    noResultsText: 'Cannot find tag available! You can create a new tag by pressing Tab.',
                    resultsFormatter: function (item) {
                        return '<li>' + item.name + '<span class="ml-5">(' + item.assigned_tag + ')</span>' + '</li>';
                    }
                }
            );

            $('#token-input-tags').attr('placeholder', 'Add or change tags (up to 5) so your post reaches more people.');
            $('#token-input-tags').bind('change keyup', function () {
                $(this).attr('placeholder', 'Add or change tags (up to 5) so your post reaches more people.');
            });
            $(document).bind('change', function () {
                $('#token-input-tags').attr('placeholder', 'Add or change tags (up to 5) so your post reaches more people.');
            });
        });
    </script>
@endsection
