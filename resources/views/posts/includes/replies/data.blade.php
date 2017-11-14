@foreach ($replies->sortByDesc('created_at') as $reply)
	<div class="bd mb-50 data-replies" style="border-top: none" data-page="{{ $lastPage }}">
		<div class="bd-top p-20">
			<div class="d-flex">
				<div class="d-flex mb-20">
					<a class="" data-toggle="popover" title="Popover title">
						<img src="storage/users/{{ $reply->user->avatar }}" class="circle img-40">
					</a>
					<div class="d-flex flex-column justify-content-center pl-10">
						<a href="" class="text-success" data-toggle="popover" title="Popover title">
							{{ $reply->user->name }}
						</a>
						<span class="font-size-12">
							{{ date('M d', strtotime($reply->created_at)) }} · {{ $reply->created_at->diffForHumans() }}
						</span>
					</div>
				</div>
			</div>
			<div class="font-serif mb-20">
				<span class="font-18 text-dark">{{ $reply->body }}</span>
			</div>
			<div class="d-flex justify-content-between">
				<div class="d-flex align-items-center like-action">
					@login
						@if ($reply->liked())
							<button class="btn btn-action bg-danger mr-16" id="unlike-Reply" data-id-reply="{{ $reply->id }}" data-like-id="{{ $reply->getLikeIdAttribute() }}">
								<i class="fa fa-heart"></i>
							</button>
							<span id="count-likes-reply">
								{{ $reply->likes->count() }}
							</span>
						@else
							<button class="btn btn-like btn-action bd-default cl-danger mr-16" id="like-reply" data-id-reply="{{ $reply->id }}">
								<i class="fa fa-heart"></i>
							</button>
							@if ($reply->likes->count() > 0)
								<span id="count-likes-reply">
									{{ $reply->likes->count() }}
								</span>
							@else
								<span id="count-likes-reply"></span>
							@endif
						@endif
					@else
						<button class="btn btn-like btn-action bd-default cl-danger mr-16" data-toggle="modal" data-target="#login-modal">
							<i class="fa fa-heart"></i>
						</button>
						@if ($reply->likes->count() > 0)
							<span id="count-likes-reply">
								{{ $reply->likes->count() }}
							</span>
						@else
							<span id="count-likes-reply"></span>
						@endif
					@endlogin
				</div>
				<div class="d-flex align-items-center">
					@login
						@if ($reply->bookmarked())
							<button class="fade-in-scale text-default  font-size-20 mr-24" id="unbookmark-reply" data-id="{{ $reply->id }}" data-bookmark-id="{{ $reply->getBookmark()->id }}">
								<i class="fa fa-bookmark"></i>
							</button>
						@else
							<button class="fade-in-scale text-default  font-size-20 mr-24" id="bookmark-reply" data-id="{{ $reply->id }}">
								<i class="fa fa-bookmark-o"></i>
							</button>
						@endif
					@else
						<button class="text-default  font-size-20 mr-24"  data-toggle="modal" data-target="#login-modal">
							<i class="fa fa-bookmark-o"></i>
						</button>
					@endlogin
				</div>
			</div>
		</div>
	</div>
@endforeach