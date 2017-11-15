@extends('layouts.app')
@section('title', 'Medium - Read, write and share posts that matter')
@section('content')
    <nav class="navigation bg-white">
        <ul class="nav align-items-center">
            <li class="nav-item py-3 pr-4 pr-sm-16">
                <a href="" class="text-dark">Home</a>
            </li>
            @foreach ($topics->slice(0, 13) as $topic)
                <li class="nav-item py-3 pr-4 pr-sm-16">
                    <a href="{{ $topic->path() }}" class="text-default text-default-hover">{{ $topic->name }}</a>
                </li>
            @endforeach
            <li class="get-started pl-4 bg-white" style="display: none">
                <button class="btn bg-success btn-shadow my-2" data-toggle="modal" data-target="#modal-signin">Get started</button>
            </li>
        </ul>
    </nav>
    <section>
        <div class="banner p-5 bg-md-none lazy" data-src="images/banner.png">
            <div class="w-half w-md-full">
                <h1 class="mb-3 font-serif font-weight-bold text-dark line-height-1">Interesting ideas that set your mind in motion.</h1>
                <h2 class="mb-3 font-size-20 text-dark font-weight-normal">Hear directly from the people who know it best. From tech to politics to creativity and more — whatever your interest, we’ve got you covered.</h2>
                <div class="d-flex">
                    <button class="btn bg-success btn-shadow mr-2" data-toggle="modal" data-target="#modal-signin">Get started</button>
                    <a href="javscript:;" class="btn btn-outline-dark btn-shadow-hover btn-shadow-active">Learn more</a>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex flex-column">
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
                                    <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
                                        <i class="fa fa-bookmark-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @foreach ($topics->slice(0, 9) as $topic)
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-30 bd-bottom">
                    <span class="block-title pb-3">
                        <a href="{{ $topic->path() }}" class="font-size-20 font-weight-bold text-dark" title="{{ $topic->name }}">{{ $topic->name }}</a>
                    </span>
                    <a href="{{ $topic->path() }}" class="d-flex align-items-center font-size-12 text-default text-default-hover">
                        <span class="mr-2 text-uppercase">More</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    @foreach ($topic->posts->slice(0, 4) as $post)
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
                                    <div class="d-flex justify-content-between mt-2">
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
                                        <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
                                            <i class="fa fa-bookmark-o"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endsection
@section('script')
    <script>
        // Fixed navigation
        window.addEventListener('load', function () {
            var navigation = $('.navigation');
            var previousScroll = navigation.offset().top;

            $(window).scroll(function () {
                var scroll = $(this).scrollTop();
                if (scroll > previousScroll) {
                    navigation.addClass('fixed').find('ul').addClass('container');
                    $('.get-started').show();
                } else {
                    navigation.removeClass('fixed').find('ul').removeClass('container');
                    $('.get-started').hide();
                }
            });
        });
    </script>
@endsection
