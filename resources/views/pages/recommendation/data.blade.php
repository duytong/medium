@foreach ($posts as $post)
    <div class="col-lg-6 last-page" data-page="{{ $lastPage }}">
        <div class="d-flex flex-column flex-lg-row w-full h-250 h-md-auto mb-30 card-shadow">
            <a href="{{ $post->path() }}" class="m-2 mr-0 mr-md-10" title="{{ $post->title }}">
                @if (!file_exists($post->pathImage()) || $post->image == null)
                    <div class="w-200 w-md-full h-full h-md-150 lazy img-error" data-src="{{ $post->pathImageError() }}"></div>
                @else
                    <div class="w-200 w-md-full h-full h-md-150 lazy bg-position-center" data-src="{{ $post->pathImage() }}"></div>
                @endif
            </a>
            <div class="d-flex flex-column justify-content-between w-full p-3">
                <div class="d-flex flex-column">
                    <a href="{{ $post->path() }}" title="{{ $post->title }}">
                        <h3 class="font-size-20 font-weight-bold text-dark">{{ _substr($post->title, 50) }}</h3>
                    </a>
                    <a href="{{ $post->path() }}" title="{{ $post->title }}">
                        <h4 class="mt-3 font-size-14 font-weight-normal text-default description">{!! _substr($post->body, 50) !!}</h4>
                    </a>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="d-flex align-items-center popover-user">
                        <div class="mr-2">
                            <a href="{{ $post->pathUser() }}">
                                <img data-src="{{ $post->userImagePath() }}" class="img-40 circle popover-trigger lazy">
                            </a>
                        </div>
                        <div class="d-flex flex-column font-size-12">
                            <a href="{{ $post->pathUser() }}" class="text-dark hover-underline popover-trigger">{{ $post->user->name }}</a>
                            <div>{{ $post->createdAt() }}</div>
                        </div>
                        <div id="popover-content" class="d-none">
                            @include('includes.popover_user')
                        </div>
                    </div>
                    @login
                        @if ($post->bookmarked())
                            <button id="unbookmark" class="fade-in-scale font-size-20 text-dark post" data-id="{{ $post->id }}" data-bookmark-id="{{ $post->getBookmarkIdAttribute() }}">
                                <i class="fa fa-bookmark"></i>
                            </button>
                        @else
                            <button id="bookmark" class="fade-in-scale font-size-20 text-default text-default-hover post" data-id="{{ $post->id }}">
                                <i class="fa fa-bookmark-o"></i>
                            </button>
                        @endif
                    @else
                        <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
                            <i class="fa fa-bookmark-o"></i>
                        </button>
                    @endlogin
                </div>
            </div>
        </div>
    </div>
@endforeach
