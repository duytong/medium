@extends('layouts.app')
@section('title', 'Search - Medium')
@section('content')
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="my-5">
				<form class="search d-flex bd-bottom pb-2" action="{{ route('search') }}" method="GET">
					<input class="form-control w-full px-0 bd-none font-size-32 font-weight-bold text-dark" type="text" placeholder="Search" name="term" autocomplete="off">
					<button class="text-dark font-size-32" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</form>
			</div>
			<div class="row justify-content-center mb-5">
				<div class="col-lg-10">
					@if (!isset($posts) || count($posts) == 0)
						<div class="font-size-20 text-dark text-center mt-5">We couldn’t find any posts.</div>
					@else
						@foreach ($posts as $post)
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
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
