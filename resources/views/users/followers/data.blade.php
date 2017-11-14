@foreach ($posts as $post)
	<div class="col-lg-6 last-page" data-page="{{ $lastPage }}">
        <div class="d-flex flex-column flex-lg-row w-full h-250 h-md-auto mb-30 bd-radius-2 box-shadow">
            <a href="{{ $post->path() }}" class="m-10 mr-0 mr-md-10" title="{{ $post->title }}">
                @if (!file_exists($post->pathImage()) || $post->image == null)
                    <div class="w-200 h-full w-md-full h-md-150 img-error lazy" data-src="{{ $post->pathImageError() }}"></div>
                @else
                    <div class="w-200 h-full w-md-full h-md-150 bg-position-center lazy" data-src="{{ $post->pathImage() }}"></div>
                @endif
            </a>
            <div class="d-flex flex-column justify-content-between w-full p-20">
                <div class="d-flex flex-column">
                    <a href="{{ $post->path() }}" title="{{ $post->title }}">
                        <h3 class="font-size-20 font-weight-bold text-dark line-height-1-2">{{ _substr($post->title, 50) }}</h3>
                    </a>
                    <a href="{{ $post->path() }}" title="{{ $post->title }}">
                        <h4 class="mt-5 font-size-14 font-weight-normal text-default">{!! _substr($post->body, 30) !!}</h4>
                    </a>
                </div>
                <div class="d-flex justify-content-between mt-10">
                    <div class="d-flex align-items-center popover-user">
                        <div class="mr-10">
                            <a href="{{ $post->pathUser() }}">
                                <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy" data-toggle="popover">
                            </a>
                        </div>
                        <div class="d-flex flex-column font-size-12">
                            <a href="{{ $post->pathUser() }}" class="text-dark hover-underline popover-trigger" data-toggle="popover">
                                {{ $post->user->name }}
                            </a>
                            <div>{{ $post->createdAt() }}</div>
                        </div>
                        <div id="popover-content" class="d-none">
                            @include('includes.popover-user')
                        </div>
                    </div>
                    @if ($post->bookmarked())
                        <button id="unbookmark-post" class="fade-in-scale font-size-20 text-dark" data-id="{{ $post->id }}" data-bookmark-id="{{ $post->getBookmarkIdAttribute() }}">
                            <i class="fa fa-bookmark"></i>
                        </button>
                    @else
                        <button id="bookmark-post" class="fade-in-scale font-size-20 text-default text-default-hover" data-id="{{ $post->id }}">
                            <i class="fa fa-bookmark-o"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
