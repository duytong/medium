@extends('layouts.app')
@section('title', $tag->name . ' - Medium')
@section('content')
	<div class="my-5">
		<div class="d-flex flex-column">
			<div class="text-uppercase font-size-20">Tagged in</div>
			<h1 class="text-dark font-weight-normal">{{ $tag->name }}</h1>
		</div>
		<div class="row mt-5">
			<div class="col-lg-4">
				<div class="font-size-16 text-dark mb-3">Explore more tags</div>
				<div class="tag mb-3">
					@foreach ($tags as $value)
						<a href="{{ route('tag.show', $value->slug) }}" class="btn btn-shadow mr-2 mb-2 bd-radius-2 text-default text-default-hover">{{ $value->name }}</a>
					@endforeach
				</div>
			</div>
			<div class="col-lg-8">
				<div class="d-flex bd-bottom mb-4">
					<div class="block-title pb-3 mr-4">
						<a href="{{ route('tag.show', $tag->slug) }}" class="text-dark">Top posts</a>
					</div>
					<div class="pb-3">
						<a href="{{ route('tag.latest', $tag->slug) }}" class="text-default text-default-hover">Latest</a>
					</div>
				</div>
				@foreach ($tag->posts->sortByDesc('view') as $post)
					<div class="d-flex mb-4">
						<div class="d-flex flex-column card-shadow p-3 w-full">
							<div class="d-flex popover-user">
								<div class="pr-2">
									<a href="{{ $post->user->path() }}">
										<img data-src="{{ $post->pathImage() }}" class="lazy circle img-40 popover-trigger">
									</a>
								</div>
								<div class="d-flex flex-column">
									<a href="{{ $post->pathUser() }}" class="text-success hover-underline popover-trigger">
										{{ $post->user->name }}
									</a>
									<div class="font-size-12">{{ $post->createdAt() }}</div>
								</div>
								<div id="popover-content" class="d-none">
									@include('includes.popover-user')
								</div>
							</div>
							<div class="d-flex flex-column justify-content-between">
								<a href="{{ $post->path() }}" class="text-dark" title="{{ $post->title }}">
									@if (!file_exists($post->pathImage()) || $post->image == null)
										<div class="my-3 lazy w-full h-100 img-error" data-src="{{ $post->pathImageError() }}"></div>
									@else
										<div class="my-3 lazy w-full h-100 bg-position-center" data-src="{{ $post->pathImage() }}"></div>
									@endif
									<div class="mb-3">
										<h3 class="font-size-24 font-weight-bold">{{ $post->title }}</h3>
									</div>
									<div class="font-serif font-size-20 description">{!! _substr($post->body, 100) !!}</div>
								</a>
								<div class="d-flex justify-content-between mt-3">
									<div class="like-action d-flex align-items-center">
										@login
											@if ($post->liked())
												<button class="btn btn-action btn-shadow bg-danger text-white fade-in-scale post" id="unlike" data-id="{{ $post->id }}" data-like-id="{{ $post->getLikeIdAttribute() }}">
													<i class="fa fa-heart"></i>
												</button>
												<span id="count-likes-post" class="ml-3">
													{{ $post->likes->count() }}
												</span>
											@else
												<button class="btn btn-shadow btn-action text-danger fade-in-scale post" id="like" data-id="{{ $post->id }}">
													<i class="fa fa-heart"></i>
												</button>
												@if ($post->likes->count() > 0)
													<span id="count-likes-post" class="ml-3">
														{{ $post->likes->count() }}
													</span>
												@else
													<span id="count-likes-post"></span>
												@endif
											@endif
										@else
											<button class="btn btn-shadow btn-action text-danger fade-in-scale" data-toggle="modal" data-target="#signin-modal">
												<i class="fa fa-heart"></i>
											</button>
											@if ($post->likes->count() > 0)
												<span id="count-likes-post" class="ml-3">
													{{ $post->likes->count() }}
												</span>
											@else
												<span id="count-likes-post"></span>
											@endif
										@endlogin
									</div>
									<div class="d-flex align-items-center">
										<a href="{{ $post->path() }}" class="text-default mr-3 d-none d-sm-block">
											@if ($post->comments->count() > 0)
												@if ($post->comments->count() > 1)
													{{ $post->comments->count() }} comments
												@else
													{{ $post->comments->count() }} comment
												@endif
											@endif
										</a>
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
					                        <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#signin-modal">
					                            <i class="fa fa-bookmark-o"></i>
					                        </button>
					                    @endlogin
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
