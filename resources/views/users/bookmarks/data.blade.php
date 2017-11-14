@foreach ($bookmarks as $bookmark)
	<div class="d-flex flex-column mb-10 last-page" data-page="{{ $lastPage }}">
		<div class="text-dark">You've bookmarked at</div>
		<div class="font-size-12">
			<i class="fa fa-bookmark mr-5 text-dark"></i>
			<span>{{ $bookmark->createdAt() }}</span>
		</div>
	</div>
	<div class="d-flex mb-30">
		<div class="d-flex flex-column bd p-3 w-full">
			@switch ($bookmark->bookmarkable_type)
				@case ('App\Post')
					<div class="d-flex align-items-center popover-user">
						<div class="pr-3">
							<a href="{{ $bookmark->bookmarkable->user->path() }}">
								<img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="lazy circle img-40 popover-trigger">
							</a>
						</div>
						<div class="d-flex flex-column font-size-12">
							<a href="{{ $bookmark->bookmarkable->user->path() }}" class="text-dark hover-underline popover-trigger">
								{{ $bookmark->bookmarkable->user->name }}
							</a>
							<div>{{ $bookmark->bookmarkable->createdAt() }}</div>
						</div>
						<div id="popover-content" class="d-none">
							@include('includes.popover-bookmark')
						</div>
					</div>
					<div class="d-flex flex-column justify-content-between">
						<a href="{{ $bookmark->bookmarkable->path() }}" class="text-dark" title="{{ $bookmark->bookmarkable->title }}">
							@if (!file_exists($bookmark->bookmarkable->pathImage()) || $bookmark->bookmarkable->image == null)
								<div class="my-3 lazy w-full h-100 img-error" data-src="{{ $bookmark->bookmarkable->pathImageError() }}"></div>
							@else
								<div class="my-3 lazy w-full h-100 bg-position-center" data-src="{{ $bookmark->bookmarkable->pathImage() }}"></div>
							@endif
							<div class="mb-3">
								<h3 class="font-size-20 font-weight-bold">{{ $bookmark->bookmarkable->title }}</h3>
							</div>
							<div class="font-serif font-size-20">{!! _substr($bookmark->bookmarkable->body, 100) !!}</div>
						</a>
						<div class="d-flex justify-content-between mt-15">
							<div class="like-action d-flex align-items-center">
								@if ($bookmark->bookmarkable->liked())
									<button class="fade-in-scale btn btn-action bg-danger text-white mr-3" id="unlike-post" data-post-id="{{ $bookmark->bookmarkable->id }}" data-like-id="{{ $bookmark->bookmarkable->getLikeIdAttribute() }}">
										<i class="fa fa-heart"></i>
									</button>
									<span id="count-likes-post">
										{{ $bookmark->bookmarkable->likes->count() }}
									</span>
								@else
									<button class="fade-in-scale btn btn-like btn-action btn-shadow text-danger mr-3" id="like-post" data-post-id="{{ $bookmark->bookmarkable->id }}">
										<i class="fa fa-heart"></i>
									</button>
									@if ($bookmark->bookmarkable->likes->count() > 0)
										<span id="count-likes-post">
											{{ $bookmark->bookmarkable->likes->count() }}
										</span>
									@else
										<span id="count-likes-post"></span>
									@endif
								@endif
							</div>
							<div class="d-flex align-items-center">
								<a href="{{ $bookmark->bookmarkable->path() }}" class="text-default  mr-24 d-none d-sm-block">
									@if ($bookmark->bookmarkable->comments->count() > 0)
										@if ($bookmark->bookmarkable->comments->count() > 1)
											{{ $bookmark->bookmarkable->comments->count() }} comments
										@else
											{{ $bookmark->bookmarkable->comments->count() }} comment
										@endif
									@endif
								</a>
								<button class="fade-in-scale text-dark font-size-20" id="unbookmark-post" data-id="{{ $bookmark->bookmarkable->id }}" data-bookmark-id="{{ $bookmark->bookmarkable->getBookmarkIdAttribute() }}">
									<i class="fa fa-bookmark"></i>
								</button>
							</div>
						</div>
					</div>
				@break
				@case ('App\comment')
					<div class="d-flex align-items-center popover-user">
						<div class="pr-10">
							<a href="{{ $bookmark->bookmarkable->user->path() }}">
								<img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="lazy circle img-40 popover-trigger" alt="{{ $bookmark->bookmarkable->user->name }}">
							</a>
						</div>
						<div class="d-flex flex-column font-size-12">
							<a href="{{ $bookmark->bookmarkable->user->path() }}" class="text-dark hover-underline popover-trigger">
								{{ $bookmark->bookmarkable->user->name }}
							</a>
							<div>{{ $bookmark->bookmarkable->createdAt() }}</div>
						</div>
						<div id="popover-content" class="d-none">
							@include('includes.popover-bookmark')
						</div>
					</div>
					<a href="{{ $bookmark->bookmarkable->post->path() }}" class="d-flex flex-column bd bd-hover bd-radius-2 mt-20 mb-20 p-20">
						<div class="d-flex justify-content-between">
							<div class="text-dark">{{ $bookmark->bookmarkable->post->title }}</div>
							<div class="d-none d-sm-inline-flex text-default ml-20">
								<div class="mr-16">
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->post->likes->count() > 0)
											<i class="fa fa-heart mr-5 text-danger"></i>
											<span>{{ $bookmark->bookmarkable->post->likes->count() }}</span>
										@endif
									</div>
								</div>
								<div>
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->post->comments->count() > 0)
											<i class="fa fa-comments mr-5 text-success"></i>
											<span>{{ $bookmark->bookmarkable->post->comments->count() }}</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="text-default">
							{{ $bookmark->bookmarkable->post->user->name }}
						</div>
						<div class="d-sm-none d-flex text-default">
							@if ($bookmark->bookmarkable->post->likes->count() > 0)
								<div class="mr-16">
									<i class="fa fa-heart mr-5 text-danger"></i>
									<span>{{ $bookmark->bookmarkable->post->likes->count() }}</span>
								</div>
							@endif
							@if ($bookmark->bookmarkable->post->comments->count() > 0)
								<div>
									<i class="fa fa-comments mr-5 text-success"></i>
									<span>{{ $bookmark->bookmarkable->post->comments->count() }}</span>
								</div>
							@endif
						</div>
					</a>
					<a href="{{ $bookmark->bookmarkable->path() }}" class="font-serif font-size-20 text-dark">
						{{ $bookmark->bookmarkable->body }}
					</a>
					<div class="d-flex justify-content-between mt-15">
						<div class="like-action d-flex align-items-center">
							@if ($bookmark->bookmarkable->liked())
								<button class="fade-in-scale btn btn-action bg-danger mr-16" id="unlike-comment" data-comment-id="{{ $bookmark->bookmarkable->id }}" data-like-id="{{ $bookmark->bookmarkable->getLikeIdAttribute() }}">
									<i class="fa fa-heart"></i>
								</button>
								<span id="count-likes-comment">
									{{ $bookmark->bookmarkable->likes->count() }}
								</span>
							@else
								<button class="fade-in-scale btn btn-like btn-action bd-default cl-danger mr-16" id="like-comment" data-comment-id="{{ $bookmark->bookmarkable->id }}">
									<i class="fa fa-heart"></i>
								</button>
								@if ($bookmark->bookmarkable->likes->count() > 0)
									<span id="count-likes-comment">
										{{ $bookmark->bookmarkable->likes->count() }}
									</span>
								@else
									<span id="count-likes-comment"></span>
								@endif
							@endif
						</div>
						<div class="d-flex align-items-center">
							<a href="{{ $bookmark->bookmarkable->path() }}" class="text-default  mr-24 d-none d-sm-block">
								@if ($bookmark->bookmarkable->replies->count() > 0)
									@if ($bookmark->bookmarkable->replies->count() > 1)
										{{ $bookmark->bookmarkable->replies->count() }} comments
									@else
										{{ $bookmark->bookmarkable->replies->count() }} comment
									@endif
								@endif
							</a>
							@if ($bookmark->bookmarkable->bookmarkable())
								<button class="fade-in-scale text-dark font-size-20 mr-24" id="unbookmark-comment" data-id="{{ $bookmark->bookmarkable->id }}" data-bookmark-id="{{ $bookmark->bookmarkable->getBookmark()->id }}">
									<i class="fa fa-bookmark"></i>
								</button>
							@else
								<button class="fade-in-scale text-default  font-size-20 mr-24" id="bookmark-comment" data-id="{{ $bookmark->bookmarkable->id }}">
									<i class="fa fa-bookmark-o"></i>
								</button>
							@endif
						</div>
					</div>
				@break
				@case ('App\Reply')
					<div class="d-flex align-items-center popover-user">
						<div class="pr-10">
							<a href="{{ $bookmark->bookmarkable->user->path() }}">
								<img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="lazy circle img-40 popover-trigger" alt="{{ $bookmark->bookmarkable->user->name }}">
							</a>
						</div>
						<div class="d-flex flex-column font-size-12">
							<a href="{{ $bookmark->bookmarkable->user->path() }}" class="text-dark hover-underline popover-trigger">
								{{ $bookmark->bookmarkable->user->name }}
							</a>
							<div>{{ $bookmark->bookmarkable->createdAt() }}</div>
						</div>
						<div id="popover-content" class="d-none">
							@include('includes.popover-bookmark')
						</div>
					</div>
					<a href="{{ $bookmark->bookmarkable->comment->path() }}" class="d-flex flex-column bd bd-hover bd-radius-2 mt-20 mb-20 p-20">
						<div class="d-flex justify-content-between">
							<div class="text-dark">{{ _substr($bookmark->bookmarkable->comment->body, 100) }}</div>
							<div class="d-none d-sm-inline-flex text-default ml-20">
								<div class="mr-16">
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->comment->likes->count() > 0)
											<i class="fa fa-heart mr-5 text-danger"></i>
											<span>{{ $bookmark->bookmarkable->comment->likes->count() }}</span>
										@endif
									</div>
								</div>
								<div>
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->comment->replies->count() > 0)
											<i class="fa fa-comments mr-5 text-success"></i>
											<span>{{ $bookmark->bookmarkable->comment->replies->count() }}</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="text-default">
							{{ $bookmark->bookmarkable->comment->user->name }}
						</div>
						<div class="d-sm-none d-flex text-default">
							@if ($bookmark->bookmarkable->comment->likes->count() > 0)
								<div class="mr-16">
									<div class="d-flex align-items-center">
										<i class="fa fa-heart mr-5 text-danger"></i>
										<span>{{ $bookmark->bookmarkable->comment->likes->count() }}</span>
									</div>
								</div>
							@endif
							@if ($bookmark->bookmarkable->comment->replies->count() > 0)
								<div>
									<div class="d-flex align-items-center">
										<i class="fa fa-comments mr-5 text-success"></i>
										<span>{{ $bookmark->bookmarkable->comment->replies->count() }}</span>
									</div>
								</div>
							@endif
						</div>
					</a>
					<div class="font-serif font-size-20 text-dark">
						{{ $bookmark->bookmarkable->body }}
					</div>
					<div class="d-flex justify-content-between mt-15">
						<div class="like-action d-flex align-items-center">
							@if ($bookmark->bookmarkable->liked())
								<button class="fade-in-scale btn btn-action bg-danger mr-16" id="unlike-reply" data-id-reply="{{ $bookmark->bookmarkable->id }}" data-like-id="{{ $bookmark->bookmarkable->getLikeIdAttribute() }}">
									<i class="fa fa-heart"></i>
								</button>
								<span id="count-likes-reply">
									{{ $bookmark->bookmarkable->likes->count() }}
								</span>
							@else
								<button class="fade-in-scale btn btn-like btn-action bd-default cl-danger mr-16" id="like-reply" data-id-reply="{{ $bookmark->bookmarkable->id }}">
									<i class="fa fa-heart"></i>
								</button>
								@if ($bookmark->bookmarkable->likes->count() > 0)
									<span id="count-likes-reply">
										{{ $bookmark->bookmarkable->likes->count() }}
									</span>
								@else
									<span id="count-likes-reply"></span>
								@endif
							@endif
						</div>
						<div class="d-flex align-items-center">
							@if ($bookmark->bookmarkable->bookmarkable())
								<button class="fade-in-scale text-dark font-size-20 mr-24" id="unbookmark-reply" data-id="{{ $bookmark->bookmarkable->id }}" data-bookmark-id="{{ $bookmark->bookmarkable->getBookmark()->id }}">
									<i class="fa fa-bookmark"></i>
								</button>
							@else
								<button class="fade-in-scale text-default  font-size-20 mr-24" id="bookmark-reply" data-id="{{ $bookmark->bookmarkable->id }}">
									<i class="fa fa-bookmark-o"></i>
								</button>
							@endif
						</div>
					</div>
				@break
			@endswitch
		</div>
	</div>
@endforeach
