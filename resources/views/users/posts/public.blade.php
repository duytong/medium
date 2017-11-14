@extends('layouts.app')
@section('title', 'Your posts - Medium')
@section('content')
	<h1 class="my-5 font-size-32 font-weight-bold text-dark">Your posts</h1>
	<div class="d-flex flex-column">
		<div class="d-flex bd-bottom">
			<div class="pb-3 mr-4">
				<a href="{{ route('drafts') }}" class="text-default text-default-hover">
					<span>Draft</span>
					@if ($countDraftPosts > 0)
						<span class="ml-1">{{ $countDraftPosts }}</span>
					@endif
				</a>
			</div>
			<div class="pb-3 block-title">
				<a href="{{ route('public') }}" class="text-dark">
					<span>Public</span>
					@if ($posts->count() > 0)
						<span class="ml-1">{{ $posts->count() }}</span>
					@endif
				</a>
			</div>
		</div>
		<div class="my-5">
			@foreach ($posts as $post)
				<div class="mb-4">
					<a href="{{ $post->path() }}" class="text-dark d-inline-block">
						<h3 class="font-size-20 font-weight-bold">{{ $post->title }}</h3>
					</a>
					<div class="d-flex mt-1">
						<span class="mr-3">Last edited {{ $post->updatedAt() }}</span>
						<ul class="nav">
							<li class="dropdown">
								<button class="dropdown-toggle text-default text-default-hover" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-angle-down font-size-20"></i>
								</button>
								<div class="dropdown-menu bd-none bd-radius-2 card-shadow">
									<a class="dropdown-item bg-none text-black text-black-hover" href="{{ route('posts.edit', $post->id) }}">Edit</a>
									<form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="form-delete">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button class="dropdown-item bg-none text-black text-black-hover">Delete</button>
									</form>
								</div>
							</li>
						</ul>
					</div>
				</div>
			@endforeach
			@if ($posts->count() < 1)
					<div class="text-center font-size-20 mt-5 text-dark">You haven’t published any public posts yet.</div>
				</div>
			@endif
		</div>
	</div>
	@include('includes.confirm')
@endsection
