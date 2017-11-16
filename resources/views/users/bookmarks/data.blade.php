@foreach ($bookmarks as $bookmark)
	<div class="d-flex mb-5 last-page" data-page="{{ $lastPage }}">
		<div class="d-flex flex-column card-shadow p-3 w-full">
			@switch ($bookmark->bookmarkable_type)
				@case ('App\Post')
					<div class="d-flex align-items-center popover-user">
						<div class="pr-2">
							<a href="{{ $bookmark->bookmarkable->user->path() }}">
								<img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="lazy circle img-40 popover-trigger">
							</a>
						</div>
						<div class="d-flex flex-column">
							<a href="{{ $bookmark->bookmarkable->user->path() }}" class="text-success hover-underline popover-trigger">
								{{ $bookmark->bookmarkable->user->name }}
							</a>
							<div class="font-size-12">{{ $bookmark->bookmarkable->createdAt() }}</div>
						</div>
						<div id="popover-content" class="d-none">
							@include('includes.popover_bookmark')
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
							<div class="font-serif font-size-20">{!! _substr($bookmark->bookmarkable->body, 200) !!}</div>
						</a>
						<div class="d-flex justify-content-between mt-15">
							<div class="d-flex align-items-center like-action">
								@if ($bookmark->bookmarkable->liked())
									<button class="fade-in-scale btn btn-action bg-danger text-white mr-3 post" id="unlike" data-id="{{ $bookmark->bookmarkable->id }}" data-like-id="{{ $bookmark->bookmarkable->getLikeIdAttribute() }}">
										<i class="fa fa-heart"></i>
									</button>
									<span id="count-likes-post">
										{{ $bookmark->bookmarkable->likes->count() }}
									</span>
								@else
									<button class="fade-in-scale btn btn-action btn-shadow text-danger mr-3 post" id="like" data-id="{{ $bookmark->bookmarkable->id }}">
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
								<a href="{{ $bookmark->bookmarkable->path() }}" class="text-default mr-3 d-none d-sm-block">
									@if ($bookmark->bookmarkable->comments->count() > 0)
										@if ($bookmark->bookmarkable->comments->count() > 1)
											{{ $bookmark->bookmarkable->comments->count() }} comments
										@else
											{{ $bookmark->bookmarkable->comments->count() }} comment
										@endif
									@endif
								</a>
								<button class="fade-in-scale text-dark font-size-20 post" id="unbookmark" data-id="{{ $bookmark->bookmarkable->id }}" data-bookmark-id="{{ $bookmark->bookmarkable->getBookmarkIdAttribute() }}">
									<i class="fa fa-bookmark"></i>
								</button>
							</div>
						</div>
					</div>
				@break
				@case ('App\Comment')
					<div class="d-flex align-items-center popover-user">
						<div class="pr-2">
							<a href="{{ $bookmark->bookmarkable->user->path() }}">
								<img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="lazy circle img-40 popover-trigger"">
							</a>
						</div>
						<div class="d-flex flex-column">
							<a href="{{ $bookmark->bookmarkable->user->path() }}" class="text-success hover-underline popover-trigger">
								{{ $bookmark->bookmarkable->user->name }}
							</a>
							<div class="font-size-12">{{ $bookmark->bookmarkable->createdAt() }}</div>
						</div>
						<div id="popover-content" class="d-none">
							@include('includes.popover_bookmark')
						</div>
					</div>
					<a href="{{ $bookmark->bookmarkable->post->path() }}" class="d-flex flex-column card-shadow card-shadow-hover my-3 p-3">
						<div class="d-flex justify-content-between">
							<div class="text-dark">{{ $bookmark->bookmarkable->post->title }}</div>
							<div class="d-none d-sm-inline-flex text-default">
								<div class="mx-3">
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->post->likes->count() > 0)
											<i class="fa fa-heart mr-1 text-danger"></i>
											<span>{{ $bookmark->bookmarkable->post->likes->count() }}</span>
										@endif
									</div>
								</div>
								<div>
									<div class="d-flex align-items-center">
										@if ($bookmark->bookmarkable->post->comments->count() > 0)
											<i class="fa fa-comments mr-1 text-success"></i>
											<span>{{ $bookmark->bookmarkable->post->comments->count() }}</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="text-default">{{ $bookmark->bookmarkable->post->user->name }}</div>
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
					<div class="d-flex flex-column justify-content-between">
						<div class="text-dark font-serif font-size-20 mb-3">{!! _substr($bookmark->bookmarkable->body, 400) !!}</div>
						<div class="d-flex justify-content-between mt-15">
							<div class="d-flex align-items-center like-action">
								@if ($bookmark->bookmarkable->liked())
									<button class="fade-in-scale btn btn-action bg-danger text-white mr-3 comment" id="unlike" data-id="{{ $bookmark->bookmarkable->id }}" data-like-id="{{ $bookmark->bookmarkable->getLikeIdAttribute() }}">
										<i class="fa fa-heart"></i>
									</button>
									<span id="count-likes-comment">
										{{ $bookmark->bookmarkable->likes->count() }}
									</span>
								@else
									<button class="fade-in-scale btn btn-action btn-shadow text-danger mr-3 comment" id="like" data-id="{{ $bookmark->bookmarkable->id }}">
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
							<div class="d-flex">
								<button class="fade-in-scale text-dark font-size-20 comment" id="unbookmark" data-id="{{ $bookmark->bookmarkable->id }}" data-bookmark-id="{{ $bookmark->bookmarkable->getBookmarkIdAttribute() }}">
									<i class="fa fa-bookmark"></i>
								</button>
							</div>
						</div>
					</div>
				@break
			@endswitch
		</div>
	</div>
@endforeach
