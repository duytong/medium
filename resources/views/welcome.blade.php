@extends('layouts.app')
@section('title', 'Medium - Read, write and share posts that matter')
@section('content')
    <nav class="navigation bg-white">
        <div class="container">
            <ul class="nav align-items-center">
                <li class="nav-item py-3 pr-4 pr-sm-16">
                    <a href="" class="text-dark">Home</a>
                </li>
                @foreach ($topics->slice(0, 13) as $topic)
                    <li class="nav-item py-3 pr-4 pr-sm-16">
                        <a href="{{ $topic->path() }}" class="text-default text-default-hover">{{ $topic->name }}</a>
                    </li>
                @endforeach
                <li class="get-started pl-4 bg-white">
                    <button class="btn bg-success box-shadow" data-toggle="modal" data-target="#modal-signin">Get started</button>
                </li>
            </ul>
        </div>
    </nav>
    <section>
        <div class="banner p-30 bg-md-none lazy" data-src="images/banner.png">
            <div class="w-50 w-md-full">
                <div class="mb-20 font-serif font-size-50 font-weight-bold text-dark line-height-1">Interesting ideas that set your mind in motion.</div>
                <div class="mb-40 font-size-20 text-dark">Hear directly from the people who know it best. From tech to politics to creativity and more — whatever your interest, we’ve got you covered.</div>
                <div class="d-flex align-items-center">
                    <button class="btn bg-success box-shadow mr-3" data-toggle="modal" data-target="#modal-signin">Get started</button>
                    <a href="javscript:;" class="btn btn-outline-dark box-shadow-hover box-shadow-active">Learn more</a>
                </div>
            </div>
        </div>
    </section>
    <main>
        <div class="d-flex flex-column">
            <div class="my-30">
                <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                    <span class="block-title pb-20">
                        <a href="{{ route('popular') }}" class="font-size-20 font-weight-bold text-dark" title="Today’s top posts">Today’s top posts</a>
                    </span>
                    <a href="{{ route('popular') }}" class="d-flex align-items-center pb-20 font-size-12 text-default text-default-hover">
                        <span class="mr-5 text-uppercase">More</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    @foreach ($popularPosts->slice(0, 4) as $post)
                        <div class="col-lg-6">
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
                                                @include('includes.popover_user')
                                            </div>
                                        </div>
                                        @login
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
                </div>
            </div>
            @foreach ($topics as $key => $topic)
                @if ($key < 10)
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center bd-bottom mb-30">
                            <span class="block-title pb-20">
                                <a href="{{ $topic->path() }}" class="font-size-20 font-weight-bold text-dark" title="{{ $topic->name }}">{{ $topic->name }}</a>
                            </span>
                            <a href="{{ $topic->path() }}" class="d-flex align-items-center pb-20 font-size-12 text-default text-default-hover">
                                <span class="mr-5 text-uppercase">More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        @if ($key < 2)
                            <div class="row">
                                @foreach ($topic->posts->slice(0, 4) as $post)
                                    <div class="col-lg-6">
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
                                                            @include('includes.popover_user')
                                                        </div>
                                                    </div>
                                                    @login
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
                            </div>
                        @elseif ($key > 1 && $key < 10)
                            <div class="row">
                                @foreach ($topic->posts as $key => $post)
                                    @if ($key == 0)
                                        <div class="col-lg-4 col-md-12 mb-30">
                                            <div class="d-flex flex-column h-550 h-md-auto bd-radius-2 box-shadow">
                                                <a href="{{ $post->path() }}" class="m-10" title="{{ $post->title }}">
                                                    @if (!file_exists($post->pathImage()) || $post->image == null)
                                                        <div class="h-260 h-md-150 img-error lazy" data-src="{{ $post->pathImageError() }}"></div>
                                                    @else
                                                        <div class="h-260 h-md-150 bg-position-center lazy" data-src="{{ $post->pathImage() }}"></div>
                                                    @endif
                                                </a>
                                                <div class="d-flex flex-column justify-content-between h-290 h-md-auto p-20">
                                                    <div class="d-flex flex-column">
                                                        <a href="{{ $post->path() }}" title="{{ $post->title }}">
                                                            <h3 class="font-size-20 font-weight-bold text-dark line-height-1-2">{{ $post->title }}</h3>
                                                        </a>
                                                        <a href="{{ $post->path() }}" class="description" title="{{ $post->title }}">
                                                            <h4 class="mt-5 font-size-14 text-default font-weight-normal">
                                                                {!! _substr($post->body, 100) !!}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-10">
                                                        <div class="d-flex align-items-center popover-user">
                                                            <div class="mr-10">
                                                                <a href="{{ $post->pathUser() }}">
                                                                    <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy">
                                                                </a>
                                                            </div>
                                                            <div class="d-flex flex-column font-size-12">
                                                                <a href="{{ $post->pathUser() }}" class="text-dark hover-underline popover-trigger">
                                                                    {{ $post->user->name }}
                                                                </a>
                                                                <div>{{ $post->createdAt() }}</div>
                                                            </div>
                                                            <div id="popover-content" class="d-none">
                                                                @include('includes.popover_user')
                                                            </div>
                                                        </div>
                                                        @login
                                                        @else
                                                            <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
                                                                <i class="fa fa-bookmark-o"></i>
                                                            </button>
                                                        @endlogin
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-lg-8 col-md-12">
                                    <div class="row">
                                        @foreach ($topic->posts as $key => $post)
                                            @if ($key > 0 && $key < 5)
                                                <div class="col-lg-6 col-md-12 mb-30">
                                                    <div class="d-flex flex-column h-260 h-md-auto bd-radius-2 box-shadow">
                                                        <a href="{{ $post->path() }}" class="m-10" title="{{ $post->title }}">
                                                            @if (!file_exists($post->pathImage()) || $post->image == null)
                                                                <div class="h-100 h-md-150 img-error lazy" data-src="{{ $post->pathImageError() }}"></div>
                                                            @else
                                                                <div class="h-100 h-md-150 bg-position-center lazy" data-src="{{ $post->pathImage() }}"></div>
                                                            @endif
                                                        </a>
                                                        <div class="d-flex flex-column justify-content-between h-160 h-md-auto p-20">
                                                            <div class="d-flex flex-column">
                                                                <a href="{{ $post->path() }}" title="{{ $post->title }}">
                                                                    <h3 class="font-size-20 font-weight-bold text-dark line-height-1-2">
                                                                        {{ _substr($post->title, 50) }}
                                                                    </h3>
                                                                </a>
                                                                <a href="{{ $post->path() }}" class="description" title="{{ $post->title }}">
                                                                    <h4 class="d-lg-none mt-5 font-size-14 text-default font-weight-normal">
                                                                        {!! _substr($post->body, 100) !!}
                                                                    </h4>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex justify-content-between mt-10">
                                                                <div class="d-flex align-items-center popover-user">
                                                                    <div class="mr-10">
                                                                        <a href="{{ $post->pathUser() }}">
                                                                            <img data-src="{{ $post->pathImageUser() }}" class="img-40 circle popover-trigger lazy">
                                                                        </a>
                                                                    </div>
                                                                    <div class="d-flex flex-column font-size-12">
                                                                        <a href="{{ $post->pathUser() }}" class="text-dark hover-underline popover-trigger">
                                                                            {{ $post->user->name }}
                                                                        </a>
                                                                        <div>{{ $post->createdAt() }}</div>
                                                                    </div>
                                                                    <div id="popover-content" class="d-none">
                                                                        @include('includes.popover_user')
                                                                    </div>
                                                                </div>
                                                                @login
                                                                @else
                                                                    <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
                                                                        <i class="fa fa-bookmark-o"></i>
                                                                    </button>
                                                                @endlogin
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </main>
    @include('layouts.includes.footer')
@endsection
@section('script')
    <script>
        // Fixed navigation
        $('.get-started').hide();
        var previousScroll = $('.navigation').offset().top;
        $(window).scroll(function () {
            var scroll = $(this).scrollTop();
            if (scroll > previousScroll) {
                $('.navigation').addClass('fixed');
                $('.get-started').show();
            } else {
                $('.navigation').removeClass('fixed');
                $('.get-started').hide();
            }
        });
    </script>
@endsection
