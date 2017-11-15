@extends('layouts.app')
@section('content')
	<section class="mt-5">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="d-flex align-items-center popover-user">
					<a href="{{ $post->user->path() }}" class="text-dark">
						<img data-src="{{ $post->user->pathImage() }}" class="lazy circle img-60 popover-trigger">
					</a>
					<div class="d-flex flex-column justify-content-center pl-3">
						<div class="d-flex">
							<a href="{{ $post->user->path() }}" class="text-dark font-size-16 popover-trigger">{{ $post->user->name }}</a>
    						@login
								@if (auth()->id() != $post->user->id)
									@if (auth()->user()->isFollowing($post->user))
										<button id="detach" class="btn btn-shadow bg-success ml-2 py-0 px-2 font-size-12 d-none d-sm-block" data-id={{ $post->user->id }}>Following</button>
									@else
										<button id="attach" class="btn btn-success ml-2 py-0 px-2 font-size-12 d-none d-sm-block" data-id={{ $post->user->id }}>Follow</button>
									@endif
								@endif
							@else
								<button class="btn btn-success ml-2 py-0 px-2 font-size-12 d-none d-sm-block" data-toggle="modal" data-target="#modal-signin">Follow</button>
							@endlogin
						</div>
						<div>{{ _substr($post->user->summary, 90) }}</div>
						<div>{{ $post->createdAtShort() }}</div>
					</div>
					<div id="popover-content" class="d-none">
						@include('includes.popover_user')
					</div>
				</div>
				<div class="text-dark mt-5">
					<h1 class="font-weight-bold line-height-1">{{ $post->title }}</h1>
					@if (!file_exists($post->pathImage()))
						<img class="mt-5 lazy w-full" data-src="{{ $post->pathImageError() }}">
					@elseif ($post->image == null)
					@else
						<img class="mt-5 lazy w-full" data-src="{{ $post->pathImage() }}">
					@endif
					<div class="mt-5 font-serif font-size-20">{!! $post->body !!}</div>
				</div>
				<div class="mt-3">
					<div class="tag">
						@foreach ($post->tags as $tag)
							<a href="{{ route('tag.show', $tag->slug) }}" class="btn btn-shadow mr-2 bd-radius-2 text-default text-default-hover">{{ $tag->name }}</a>
						@endforeach
					</div>
					<div class="my-5">
						<div class="text-center font-size-16">Enjoy this post? Give <span class="text-dark">{{ $post->user->name }}</span> a heart if it's helpful.</div>
						<div class="d-flex justify-content-between align-items-center">
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
									<button class="btn btn-shadow btn-action text-danger fade-in-scale" data-toggle="modal" data-target="#modal-signin">
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
					<div class="d-flex align-items-center">
						<a href="{{ $post->user->path() }}" class="text-dark">
							<img data-src="{{ $post->user->pathImage() }}" class="lazy circle img-60" title="{{ $post->user->name }}">
						</a>
						<div class="d-flex flex-column justify-content-center pl-3 w-full">
							<div class="d-flex justify-content-between align-items-center">
								<a href="{{ $post->user->path() }}" class="text-dark font-weight-bold font-size-18" title="{{ $post->user->name }}">
									{{ $post->user->name }}
								</a>
								@login
									@if (auth()->id() != $post->user->id)
										@if (auth()->user()->isFollowing($post->user)) 
											<button id="detach" class="btn btn-shadow bg-success" data-id={{ $post->user->id }}>Following</button>
										@else
											<button id="attac" class="btn btn-success" data-id={{ $post->user->id }}>Follow</button>
										@endif
									@endif
								@else
									<button class="btn btn-success" data-toggle="modal" data-target="#modal-signin">Follow</button>
								@endlogin
							</div>
							<div class="text-black">{{ $post->user->summary }}</div>
						</div>
					</div>
				</div>
		</div>
	</section>
	<section class="mt-5">
		<div class="row">
			@foreach ($randomPosts as $randomPost)
				<div class="col-lg-4">
					@include('posts.includes.random')
				</div>
			@endforeach
		</div>
		<div class="row justify-content-center mt-5">
			<div class="col-lg-8
				@login
				@else
					mb-5
				@endlogin
			">
				<div class="text-black font-weight-bold mb-3">Comments</div>
				@login
					<div class="area-comment mb-5">
						<div class="d-flex mb-3">
							<a href="{{ auth()->user()->path() }}" class="text-dark">
								<img data-src="{{ auth()->user()->pathImage() }}" class="lazy circle img-40" alt="{{ auth()->user()->name }}">
							</a>
							<div class="d-flex flex-column justify-content-center pl-2">
								<a href="" class="text-success">{{ auth()->user()->name }}</a>
								<span class="font-size-12 text-black typing">
									{{ date('M d', strtotime(Carbon\Carbon::now())) }}
								</span>
							</div>
						</div>
						<textarea class="form-comment font-serif card-shadow p-4 w-full font-size-18 text-dark mb-3 bd-none"></textarea>
						<button class="btn btn-shadow bg-success publish-comment" data-id="{{ $post->id }}">Publish</button>
						<button class="btn btn-shadow text-default text-default-hover ml-2 cancel">Cancel</button>
					</div>
					<div class="raw-form cursor-text font-serif card-shadow text-default mb-5 p-4 font-size-18">Write a comment</div>
				@else
					<div class="mb-70 p-4 card-shadow bg-white cursor-text font-serif font-size-18 text-default" data-toggle="modal" data-target="#modal-signin">Write a comment</div>
				@endlogin
				<div id="data-comments">
					@include('posts.includes.comments')
				</div>
				@foreach ($comments as $key => $comment)
					@if ($key == 0 && $comment->count() > 10)
						<button class="show-comments card-shadow card-shadow-hover text-success p-4 w-full mb-5">Show all comments</button>
					@endif
				@endforeach
				<div class="d-flex justify-content-center">
					<div class="spinner mb-5" style="display: none"></div>
				</div>
			</div>
		</div>
	</section>
	@login
	@else
		<div class="footer bg-white py-3">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8 d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center">
							<img data-src="{{ $post->pathImageUser() }}" class="img-40 circle lazy">
							<div class="pl-3 font-size-16 text-dark">Never miss a post from <span class="font-weight-bold">{{ $post->user->name }}</span>, when you sign up for Medium.</div>
						</div>
						<div>
							<button class="btn btn-shadow bg-success text-uppercase font-weight-bold" data-toggle="modal" data-target="#modal-signin">Get started</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endlogin
@endsection
