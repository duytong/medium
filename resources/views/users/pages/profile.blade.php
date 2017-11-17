@extends('layouts.app')
@section('title', $profile->name . ' - Medium')
@section('content')
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<section class="my-5">
				<div class="d-flex flex-column align-items-center">
					<img data-src="{{ $profile->pathImage() }}" class="circle img-100 lazy">
					<div class="d-flex flex-column align-items-center">
						<h1 class="text-dark font-weight-bold mt-2">{{ $profile->name }}</h1>
						<h2 class="font-weight-normal font-size-20 text-dark">{{ $profile->summary }}</h2>
						<div class="text-success">Join Medium since {{ $profile->createdAt()}}</div>
					</div>
				</div>
				<div class="d-flex flex-column align-items-center mt-3">
					<div class="d-flex">
						@if ($profile->following->count() > 0)
							<a href="{{ route('following', $profile->username) }}" class="text-default text-default-hover mr-2">
								<span class="font-weight-bold">{{ $profile->following->count() }}</span>
								<span> Following</span>
							</a>
						@endif
						@if ($profile->followers->count() > 0)
							<a href="{{ route('followers', $profile->username) }}" class="text-default text-default-hover">
								<span class="font-weight-bold">{{ $profile->followers->count() }}</span>
								<span> Followers</span>
							</a>
						@endif
					</div>
					@if (auth()->id() != $profile->id)
						<div class="d-inline-block my-2">
							@login
								@if (auth()->user()->isFollowing($profile)) 
									<button id="detach" class="btn btn-shadow bg-success" data-id={{ $profile->id }}>Following</button>
								@else
									<button id="attach" class="btn btn-success" data-id={{ $profile->id }}>Follow</button>
								@endif
							@else
								<button class="btn btn-success" data-toggle="modal" data-target="#modal-signin">Follow</button>
							@endlogin
						</div>
					@endif
					<div class="mt-2
						@if (auth()->id() == $profile->id)
							mt-3
						@endif
					">
						@foreach ($profile->socials as $social)
							@switch ($social->provider)
								@case ('twitter')
									<a href="{{ $social->provider_url }}" class="text-default text-default-hover font-size-20">
										<i class="fa fa-twitter"></i>
									</a>
								@break
								@case ('facebook')
									<a href="{{ $social->provider_url }}" class="text-default text-default-hover font-size-20 mx-2">
										<i class="fa fa-facebook"></i>
									</a>
								@break
								@case ('github')
									<a href="{{ $social->provider_url }}" class="text-default text-default-hover font-size-20">
										<i class="fa fa-github"></i>
									</a>
								@break
							@endswitch
						@endforeach
					</div>
				</div>
			</section>
			<section class="my-5">
				@if ($profile->posts->count() > 0)
					<div class="d-flex bd-bottom">
						<div class="block-title pb-3 mr-4">
							<a href="{{ $profile->path() }}" class="text-dark">Profile</a>
						</div>
					</div>
				@endif
				<div class="mt-5">
					@foreach ($profile->posts as $post)
						<div class="d-flex mb-4">
							<div class="d-flex flex-column card-shadow p-3 w-full">
								<div class="d-flex popover-user">
									<div class="pr-2">
										<a href="{{ $profile->path() }}">
											<img data-src="{{ $profile->pathImage() }}" class="lazy circle img-40 popover-trigger">
										</a>
									</div>
									<div class="d-flex flex-column justify-content-center">
										<a href="{{ $profile->path() }}" class="text-success hover-underline popover-trigger">
											{{ $profile->name }}
										</a>
										<div class="font-size-12">{{ $post->createdAt() }}</div>
									</div>
									<div id="popover-content" class="d-none">
										@include('includes.popover_user')
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
						                        <button class="fade-in-scale font-size-20 text-default text-default-hover" data-toggle="modal" data-target="#modal-signin">
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
			</section>
		</div>
	</div>
@endsection
