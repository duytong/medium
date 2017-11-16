<div class="d-flex flex-column h-300 card-shadow">
	<a href="{{ $randomPost->path() }}" title="{{ $randomPost->title }}" class="m-2">
		@if (!file_exists($randomPost->pathImage()) || $randomPost->image == null)
            <div class="h-100 lazy img-error" data-src="{{ $randomPost->pathImageError() }}"></div>
        @else
            <div class="h-100 lazy bg-position-center" data-src="{{ $randomPost->pathImage() }}"></div>
        @endif
	</a>
	<div class="d-flex flex-column justify-content-between h-200 p-3">
		<a href="{{ $randomPost->path() }}" class="mb-3">
			<h3 class="font-size-20 font-weight-bold text-dark">{{ _substr($randomPost->title, 50) }}</h3>
		</a>
		<div class="d-flex justify-content-between align-items-center">
			<div class="d-flex align-items-center popover-user">
				<a href="{{ $randomPost->user->path() }}">
					<img data-src="{{ $randomPost->user->pathImage() }}" class="lazy circle img-40 popover-trigger" alt="{{ $randomPost->user->name }}">
				</a>
				<div class="d-flex flex-column justify-content-center pl-2">
					<a href="{{ $randomPost->user->path() }}" class="text-dark popover-trigger">{{ $randomPost->user->name }}</a>
					<span class="font-size-12">{{ $randomPost->createdAt() }}</span>
				</div>
				<div id="popover-content" class="d-none">
					@include('includes.popover_user_2')
				</div>
			</div>
			<div class="like-action d-flex align-items-center">
				@login
					@if ($randomPost->liked())
						<button class="btn btn-action btn-shadow bg-danger text-white fade-in-scale post" id="unlike" data-id="{{ $randomPost->id }}" data-like-id="{{ $randomPost->getLikeIdAttribute() }}">
							<i class="fa fa-heart"></i>
						</button>
						<span id="count-likes-post" class="ml-3">
							{{ $randomPost->likes->count() }}
						</span>
					@else
						<button class="btn btn-shadow btn-action text-danger fade-in-scale post" id="like" data-id="{{ $randomPost->id }}">
							<i class="fa fa-heart"></i>
						</button>
						@if ($randomPost->likes->count() > 0)
							<span id="count-likes-post" class="ml-3">
								{{ $randomPost->likes->count() }}
							</span>
						@else
							<span id="count-likes-post"></span>
						@endif
					@endif
				@else
					<button class="btn btn-shadow btn-action text-danger fade-in-scale" data-toggle="modal" data-target="#modal-signin">
						<i class="fa fa-heart"></i>
					</button>
					@if ($randomPost->likes->count() > 0)
						<span id="count-likes-post" class="ml-3">
							{{ $randomPost->likes->count() }}
						</span>
					@else
						<span id="count-likes-post"></span>
					@endif
				@endlogin
				<div class="bd-right mx-3 h-20"></div>
				@login
                    @if ($randomPost->bookmarked())
                        <button id="unbookmark" class="fade-in-scale font-size-20 text-dark post" data-id="{{ $randomPost->id }}" data-bookmark-id="{{ $randomPost->getBookmarkIdAttribute() }}">
                            <i class="fa fa-bookmark"></i>
                        </button>
                    @else
                        <button id="bookmark" class="fade-in-scale font-size-20 text-default text-default-hover post" data-id="{{ $randomPost->id }}">
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
