@extends('layouts.app')
@section('title', 'Editing as - Medium')
@section('content')
    <main>
        <div class="my-50">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <a href="{{ $post->pathUser() }}">
                                <img data-src="{{ $post->pathImageUser() }}" class="circle img-40 mr-8 lazy" title="{{ $post->user->name }}">
                            </a>
                            <div class="d-flex flex-column justify-content-center">
                                <a href="{{ $post->pathUser() }}" class="text-success text-success-hover" title="{{ $post->user->name }}">
                                    {{ $post->user->name }}
                                </a>
                                <div class="font-size-12">Draft</div>
                            </div>
                        </div>
                        <div class="mt-20">
                            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <select id="topic" class="w-full" name="topic_id">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->topics->sortBy('name') as $topic)
                                                    <option value="{{ $topic->id }}"
                                                        @if ($topic->id == $post->topic_id)
                                                            selected 
                                                        @endif>
                                                        {{ $topic->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="title" class="form-control p-0 bd-none font-size-40 font-weight-bold text-dark" name="title" placeholder="Title" autofocus autocomplete="off" value="{{ $post->title }}">
                                </div>
                                <textarea class="medium-editor font-serif font-size-20 text-dark" name="body" contenteditable="true" data-placeholder="Tell your post...">{!! $post->body !!}</textarea>
                                <div class="form-group">
                                    <input name="tags" id="tags" value="
                                        @foreach ($post->tags as $tag)
                                            @if ($loop->last)
                                                {{ $tag->name }}
                                            @else
                                                {{ $tag->name }},
                                            @endif
                                        @endforeach
                                    ">
                                    <div id="data" class="d-none">{{ $tags }}</div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center form-group">
                                    @if (!empty($post->image))
                                        <div class="mb-5" id="file-name">{{ $post->image }}</div>
                                    @else
                                        <div class="mb-5" id="file-name">No file selected (optional)</div>
                                    @endif
                                    <label for="file-selector" class="btn box-shadow mb-0">
                                        <input type="file" id="file-selector" class="d-none" name="image">
                                            <i class="fa fa-image mr-5"></i>Upload
                                    </label>
                                </div>
                                <input type="hidden" id="post-id" name="post_id" value="{{ $post->id }}">
                                <input type="submit" id="btn-submit" class="btn bg-success box-shadow float-right" name="publish" value="Publish" data-toggle="tooltip" data-placement="top" title="Publishing will become available after you start writing and select a topic.">
                                @if ($errors->has('image'))
                                    <div class="alert alert-bar" role="alert">{{ $errors->first('image') }}</div>
                                @endif       
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        // Search tags.
        var data = $('#data').html();
        var json = JSON.parse(data);

        $(function () {
            var urlSearchTags = window.location.origin + '/search-tags';

            $('#tags').tokenInput(
                urlSearchTags,
                {
                    theme: 'facebook',
                    tokenLimit: 5,
                    searchDelay: 500,
                    allowFreeTagging: true,
                    hintText: false,
                    tokenValue: 'name',
                    noResultsText: 'Cannot find tag available! You can create a new tag by pressing Tab.',
                    resultsFormatter: function (item) {
                        return '<li>' + item.name + '<span class="ml-5">(' + item.assigned_tag + ')</span>' + '</li>';
                    },
                    prePopulate: $.each(json, function() {
                        [{ 'name': json.name }]
                    })
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
