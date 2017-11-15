@foreach ($comments as $comment)
	<div class="card-shadow mb-5 last-page" data-page="{{ $lastPage }}">
		<div class="p-4">
			<div class="d-flex">
				<div class="d-flex mb-3">
					<a href="{{ $comment->pathUser() }}">
						<img data-src="{{ $comment->pathImageUser() }}" class="circle img-40 lazy">
					</a>
					<div class="d-flex flex-column justify-content-center pl-2">
						<a href="{{ $comment->pathUser() }}" class="text-success">{{ $comment->user->name }}</a>
						<span class="font-size-12">{{ $comment->createdAt() }}</span>
					</div>
				</div>
			</div>
			<div class="mb-3">{{ $comment->body }}</div>
			<div class="d-flex justify-content-between">
				<div class="d-flex align-items-center like-action">
					@login
						@if ($comment->liked())
							<button class="btn btn-action btn-shadow bg-danger text-white fade-in-scale comment" id="unlike" data-id="{{ $comment->id }}" data-like-id="{{ $comment->getLikeIdAttribute() }}">
								<i class="fa fa-heart"></i>
							</button>
							<span id="count-likes-comment" class="ml-3">{{ $comment->likes->count() }}</span>
						@else
							<button class="btn btn-shadow btn-action text-danger fade-in-scale comment" id="like" data-id="{{ $comment->id }}">
								<i class="fa fa-heart"></i>
							</button>
							@if ($comment->likes->count() > 0)
								<span id="count-likes-comment" class="ml-3">{{ $comment->likes->count() }}</span>
							@else
								<span id="count-likes-comment"></span>
							@endif
						@endif
					@else
						<button class="btn btn-shadow btn-action text-danger fade-in-scale" data-toggle="modal" data-target="#modal-signin">
							<i class="fa fa-heart"></i>
						</button>
						@if ($comment->likes->count() > 0)
							<span id="count-likes-comment" class="ml-3">{{ $comment->likes->count() }}</span>
						@else
							<span id="count-likes-comment"></span>
						@endif
					@endlogin
				</div>
				<div class="d-flex align-items-center">
					@login
						@if ($comment->bookmarked())
							<button class="fade-in-scale text-dark font-size-20 comment" id="unbookmark" data-id="{{ $comment->id }}" data-bookmark-id="{{ $comment->getBookmarkIdAttribute() }}">
								<i class="fa fa-bookmark"></i>
							</button>
						@else
							<button class="fade-in-scale text-default text-default-hover font-size-20 comment" id="bookmark" data-id="{{ $comment->id }}">
								<i class="fa fa-bookmark-o"></i>
							</button>
						@endif
					@else
						<button class="fade-in-scale text-default text-default-hover font-size-20" data-toggle="modal" data-target="#modal-signin">
							<i class="fa fa-bookmark-o"></i>
						</button>
					@endlogin
				</div>
			</div>
		</div>
	</div>
@endforeach
