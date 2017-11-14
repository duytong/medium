@extends('layouts.app')
@section('title', _substr($comment->body, 50) . ' - Medium')
@section('content')
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="p-35-0-10">
						<div class="d-flex">
							<a href="{{ $comment->user->path() }}">
								<img data-src="{{ $comment->user->pathImage() }}" class="circle img-60 lazy" alt="{{ $comment->user->name }}">
							</a>
							<div class="d-flex flex-column justify-content-center pl-16">
								<div class="d-flex">
									<a href="{{ $comment->user->path() }}" class="text-dark  font-15">{{ $comment->user->name }}</a>
									<button class="btn btn-success ml-10 p-0-10 font-size-12 d-none d-sm-block">Follow</button>
								</div>
								<div class="font-13">{{ _substr($comment->user->summary, 100) }}</div>
								<div class="font-13">{{ $comment->createdAt() }}</div>
							</div>
						</div>
					</div>
					<a href="{{ $comment->post->path() }}" class="d-flex flex-column bd bd-hover bd-radius-2 mt-10 p-20">
						<div class="d-flex justify-content-between">
							<div class="text-dark">{{ $comment->post->title }}</div>
							<div class="d-flex">
								<div class="cl-medium mr-10">
									<i class="fa fa-heart"></i>
									<span>{{ $comment->likes->count() }}</span>
								</div>
								<div class="cl-medium">
									<i class="fa fa-comments"></i>
									<span>{{ $comment->replies->count() }}</span>
								</div>
							</div>
						</div>
						<div class="text-default">{{ $comment->post->user->name }}</div>
					</a>
					<div class="mr-40-0 font-serif font-size-20 text-dark">{{ $comment->body }}</div>
					<div>
						<div class="text-center font-16">Enjoy this comment? Give <span class="text-dark">{{ $comment->user->name }}</span> a heart if it's helpful.</div>
						<div class="post-action d-flex justify-content-between align-items-center">
							<div class="like-action d-flex align-items-center">
								@login
									@if ($comment->liked())
										<button class="btn btn-action bg-danger mr-16" id="unlike-comment" data-comment-id="{{ $comment->id }}" data-like-id="{{ $comment->getLikeIdAttribute() }}">
											<i class="fa fa-heart"></i>
										</button>
										<span id="count-likes-comment">
											{{ $comment->likes->count() }}
										</span>
									@else
										<button class="btn btn-like btn-action bd-default cl-danger mr-16" id="like-comment" data-comment-id="{{ $comment->id }}">
											<i class="fa fa-heart"></i>
										</button>
										@if ($comment->likes->count() > 0)
											<span id="count-likes-comment">
												{{ $comment->likes->count() }}
											</span>
										@else
											<span id="count-likes-comment"></span>
										@endif
									@endif
								@else
									<button class="btn btn-like btn-action bd-default cl-danger" data-toggle="modal" data-target="#login-modal">
										<i class="fa fa-heart"></i>
									</button>
									@if ($comment->likes->count() > 0)
										<span id="count-likes-comment">
											{{ $comment->likes->count() }}
										</span>
									@else
										<span id="count-likes-comment"></span>
									@endif
								@endlogin
							</div>
							<div class="d-flex align-items-center">
								<div class="d-flex align-items-center mr-24">
									<button class="btn btn-comment btn-action bd-default text-success mr-16"><i class=" fa fa-comments"></i></button>
									<span id="count-likes-comment">6</span>
								</div>
								{{-- <div class="dropdown mr-24 share-dropdown">
									<button class="dropdown-toggle text-default " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="ti-share font-size-20"></i>
										<span class="font-16">Share</span>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item text-default  bg-none" href="#"><i class="fa fa-facebook mr-8"></i>Share on Facebook</a>
										<a class="dropdown-item text-default  bg-none" href="#"><i class="fa fa-twitter mr-8"></i>Share on twitter</a>
									</div>
								</div> --}}
								@include('pages.share', [
									'url' => request()->fullUrl(),
									'description' => $comment->title,
									])
									@login
										@if ($comment->bookmarked())
											<button class="text-default  font-size-20 mr-24" id="unbookmark-comment" data-id="{{ $comment->id }}" data-bookmark-id="{{ $comment->getBookmark()->id }}">
												<i class="fa fa-bookmark"></i>
											</button>
										@else
											<button class="text-default  font-size-20 mr-24" id="bookmark-comment" data-id="{{ $comment->id }}">
												<i class="fa fa-bookmark-o"></i>
											</button>
										@endif
									@else
										<button class="text-default  font-size-20 mr-24"  data-toggle="modal" data-target="#login-modal">
											<i class="fa fa-bookmark-o"></i>
										</button>
									@endlogin
									<button class="text-default  font-size-20"><i class="fa fa-ellipsis-h"></i></button>
								</div>
							</div>
							<div class="d-flex">
								<a href="{{ $comment->user->path() }}">
									<img data-src="{{ $comment->user->pathImage() }}" class="circle img-60 lazy" alt="{{ $comment->user->name }}">
								</a>
								<div class="d-flex flex-column justify-content-center pl-16 w-full">
									<div class="d-flex justify-content-between align-items-center">
										<a href="" class="text-dark text-success-event font-weight-bold font-18">{{ $comment->user->name }}</a>
										<button class="btn btn-success">Follow</button>
									</div>
									<div class="text-success font-13 mb-8">Medium member since {{ $comment->user->createdAt() }}</div>
									<div class="cl-medium font-size-14">{{ $comment->user->summary }}</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div class="mr-70-0">
				<div class="row">
					@foreach ($randomposts as $randompost)
						<div class="col-lg-4">
							@include('posts.includes.random')
						</div>
					@endforeach
				</div>
			</div>
			<div class="mb-50">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="cl-medium font-600 mb-20">comments</div>
						@login
							<div class="area-comment mb-50">
								<div class="d-flex mb-20">
									<a class="{{ auth()->user()->path() }}">
										<img data-src="{{ auth()->user()->pathImage() }}" class="circle img-40 lazy" alt="{{ auth()->user()->name }}">
									</a>
									<div class="d-flex flex-column justify-content-center pl-10">
										<a href="{{ auth()->user()->path() }}" class="text-success">{{ auth()->user()->name }}</a>
										<span class="font-size-12 cl-medium typing">
											{{ date('M d', strtotime(Carbon\Carbon::now())) }}
										</span>
									</div>
								</div>
								<textarea class="form-reply bd-radius-2 font-serif p-20 w-full font-18 text-dark mb-8 bd"></textarea>
								<button class="btn btn-medium bg-success publish-reply" data-comment-id="{{ $comment->id }}">Publish</button>
								<button class="btn btn-medium btn-default text-default  ml-10 cancel">Cancel</button>
							</div>
						@else
							<div class="area-comment mb-50">
								<p class="text-center font-16">Please <button class="text-success hover-underline" data-toggle="modal" data-target="#login-modal">sign in</button> to participate in this discussion.</p>
							</div>
						@endlogin
						<div class="write-comment l-h-35 font-serif bd bd-radius-2 bd-hover text-default p-20 w-full mb-50 font-18 text-left">Write a comment</div>
						<div id="data-replies">
							@include('posts.includes.replies.data')
						</div>
						@foreach ($replies as $key => $reply)
							@if ($key == 0 && $reply->count() > 5)
								<button class="show-replies l-h-35 bd bd-radius-2 bd-hover text-success p-20 w-full">Show all comments</button>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('script')
	<script>
		var idcomment = $('.publish-reply').data('id-comment');
		var page = 1;

		$('.show-replies').click(function () {
			page++;

			if (page == $('.data-replies').data('page')) {
				$('.show-replies').hide();
			}

			$.ajax({
				url:  'comment/' + idcomment + '/replies/?page=' + page,
				type: 'GET',
				success: function (data) {
					$('#data-replies').append(data);
				}
			})
		});
	</script>
@endsection