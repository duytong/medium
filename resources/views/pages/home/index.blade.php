@extends('layouts.app')
@section('title', 'Medium - Read, write and share posts that matter')
@section('content')
	<div class="d-flex flex-column">
        <div class="my-30">
            <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                <span class="block-title pb-3">
                    <a href="{{ route('posts.popular') }}" class="font-size-20 font-weight-bold text-dark" title="Today’s top posts">Today’s top posts</a>
                </span>
                <a href="{{ route('posts.popular') }}" class="d-flex align-items-center font-size-12 text-default text-default-hover">
                    <span class="mr-2 text-uppercase">More</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <div class="row">
                @foreach ($postsPopular->slice(0, 4) as $post)
                    <div class="col-lg-6">
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
                                                <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy">
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
                                    @if ($post->bookmarked())
                                        <button id="unbookmark" class="fade-in-scale font-size-20 text-dark post" data-id="{{ $post->id }}" data-bookmark-id="{{ $post->getBookmarkIdAttribute() }}">
                                            <i class="fa fa-bookmark"></i>
                                        </button>
                                    @else
                                        <button id="bookmark" class="fade-in-scale font-size-20 text-default text-default-hover post" data-id="{{ $post->id }}">
                                            <i class="fa fa-bookmark-o"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
		@if (isset($postsFollowers))
			<div class="my-30">
                <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                    <span class="block-title pb-3">
                        <a href="{{ route('posts.followers') }}" class="font-size-20 font-weight-bold text-dark" title="Posts form followers">Posts form followers</a>
                    </span>
                    <a href="{{ route('posts.followers') }}" class="d-flex align-items-center font-size-12 text-default text-default-hover">
                        <span class="mr-2 text-uppercase">More</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    @foreach ($postsFollowers->slice(0, 4) as $post)
                        <div class="col-lg-6">
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
                                                    <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy">
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
                                        @if ($post->bookmarked())
                                            <button id="unbookmark" class="fade-in-scale font-size-20 text-dark post" data-id="{{ $post->id }}" data-bookmark-id="{{ $post->getBookmarkIdAttribute() }}">
                                                <i class="fa fa-bookmark"></i>
                                            </button>
                                        @else
                                            <button id="bookmark" class="fade-in-scale font-size-20 text-default text-default-hover post" data-id="{{ $post->id }}">
                                                <i class="fa fa-bookmark-o"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
		@endif
		@if (!empty($subscribedTopics))
			<div class="mb-30">
                <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                    <div class="block-title pb-3">
                        <div class="font-size-20 font-weight-bold text-dark">Subscribed topics</div>
                    </div>
                </div>
                <div class="row justify-content-center">
                	<div class="col-lg-10">
            			<div class="d-flex justify-content-center owl-carousel">
		                    @foreach ($subscribedTopics as $subscribedTopic)
		                    	<div class="d-flex flex-column align-items-center mb-30 card-shadow">
		                    		<div class="d-flex w-full p-3">
		                    			<a href="{{ $subscribedTopic->path() }}" class="text-dark" title="{{ $subscribedTopic->name }}">
		                    				<h3 class="font-size-20 font-weight-bold">{{ $subscribedTopic->name }}</h3>
		                    			</a>
		                    		</div>
		                    		<a href="{{ $subscribedTopic->path() }}" class="w-full" title="{{ $subscribedTopic->name }}">
                                        @if (file_exists($subscribedTopic->pathImage()))
                                            <div class="h-180 m-2 bg-position-center lazy" data-src="{{ $subscribedTopic->pathImage() }}"></div>
                                        @else
                                            <div class="h-180 m-2 img-error lazy" data-src="{{ $subscribedTopic->pathImageError() }}"></div>
                                        @endif
		                    		</a>
		                    	</div>
		                    @endforeach
            			</div>
	                </div>
                </div>
            </div>
		@endif
        <div id="scroll-data">
            @include('pages.home.data')
        </div>
        <div class="my-30">
            <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                <span class="block-title pb-3">
                    <a href="{{ route('posts.recommendation') }}" class="font-size-20 font-weight-bold text-dark" title="You might like">You might like</a>
                </span>
                <a href="{{ route('posts.recommendation') }}" class="d-flex align-items-center font-size-12 text-default text-default-hover">
                    <span class="mr-2 text-uppercase">More</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <div class="row">
                @foreach ($postsRecommendation->slice(0, 4) as $post)
                    <div class="col-lg-6">
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
                                                <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy">
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
                                    @if ($post->bookmarked())
                                        <button id="unbookmark" class="fade-in-scale font-size-20 text-dark post" data-id="{{ $post->id }}" data-bookmark-id="{{ $post->getBookmarkIdAttribute() }}">
                                            <i class="fa fa-bookmark"></i>
                                        </button>
                                    @else
                                        <button id="bookmark" class="fade-in-scale font-size-20 text-default text-default-hover post" data-id="{{ $post->id }}">
                                            <i class="fa fa-bookmark-o"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if (count($exploreTopics) > 0)
            <div class="mb-30">
                <div class="d-flex justify-content-between align-items-center bd-bottom mb-30">
                    <span class="block-title pb-3">
                        <a href="{{ route('topics') }}" class="font-size-20 font-weight-bold text-dark" title="Explore more topics">Explore more topics</a>
                    </span>
                    <a href="{{ route('topics') }}" class="d-flex align-items-center font-size-12 text-default text-default-hover">
                        <span class="mr-2 text-uppercase">More</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row justify-content-center">
                            @foreach ($exploreTopics as $key => $exploreTopic)
                                <div class="col-lg-4 col-md-6 mb-30
                                    @if ($key == 2)
                                        d-none d-lg-block
                                    @endif">
                                    <div class="d-flex flex-column align-items-center card-shadow">
                                        <div class="d-flex justify-content-between align-items-center w-full p-3">
                                            <a href="{{ $exploreTopic->path() }}" class="text-dark" title="{{ $exploreTopic->name }}">
                                                <h3 class="font-size-20 font-weight-bold">{{ $exploreTopic->name }}</h3>
                                            </a>
                                            @if (auth()->user()->subscribed($exploreTopic))
                                                <button id="detach" class="btn btn-action circle bg-dark-blue btn-shadow star topic" data-id="{{ $exploreTopic->id }}">
                                                    <i class="fa fa-star"></i>
                                                </button>
                                            @else
                                                <button id="attach" class="btn btn-action btn-star circle text-dark-blue star topic" data-id="{{ $exploreTopic->id }}">
                                                    <i class="fa fa-star"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a href="{{ $exploreTopic->path() }}" class="w-full" title="{{ $exploreTopic->name }}">
                                            @if (file_exists($exploreTopic->pathImage()))
                                                <div class="h-180 m-2 bg-position-center lazy" data-src="{{ $exploreTopic->pathImage() }}"></div>
                                            @else
                                                <div class="h-180 m-2 img-error lazy" data-src="{{ $exploreTopic->pathImageError() }}"></div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('footer')
    @include('layouts.includes.footer')
@endsection
@section('script')
	<script>
        // Triggered owlCarousel
        window.addEventListener('load', function () {
    		$('.owl-carousel').owlCarousel({
    			margin: 30,
    			lazyLoad: true,
    			dots: false,
    			nav: true,
    			navText : ['<span class="font-size-32 text-default-hover">&lsaquo;</span>', '<span class="font-size-32 text-default-hover">&rsaquo;</span>'],
    			responsiveClass:true,
    			responsive: {
    				0: {
    					items: 1
    				},
    				768: {
    					items: 2
    				},
    				992:{
    					items: 3
    				}
    			}
    		})
        });
	</script>
@endsection
