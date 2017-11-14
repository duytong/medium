@extends('layouts.app')
@section('title', 'Following by ' . $profile->name . ' - Medium')
@section('content')
	<div class="row justify-content-center">
		<div class="col-lg-4">
			<div class="my-5">
				@if (isset($users))
					@foreach ($users as $user)
						<div class="d-flex justify-content-between align-items-center mb-5">
							<div class="d-flex align-items-center">
								<a href="{{ $user->path() }}">
									<img data-src="{{ $user->pathImage() }}" class="circle img-40 lazy">
								</a>
								<div class="d-flex flex-column ml-2">
									<a href="{{ $user->path() }}" class="text-dark hover-underline">{{ $user->name }}</a>
									<div class="font-size-12">{{ $user->createdAt() }}</div>
								</div>
							</div>
							<div class="d-inline-block">
								@login
									@if (auth()->user()->isFollowing($user)) 
										<button id="detach" class="btn btn-shadow bg-success" data-id={{ $user->id }}>Following</button>
									@else
										<button id="attach" class="btn btn-success" data-id={{ $user->id }}>Follow</button>
									@endif
								@else
									<button class="btn btn-success" data-toggle="modal" data-target="#signin-modal">Follow</button>
								@endlogin
							</div>
						</div>
					@endforeach
				@else
					@if ($profile->id == auth()->user()->id)
						<div class="font-size-20 text-dark text-center mt-5">You are not following any user.</div>
					@else
						<div class="font-size-20 text-dark text-center mt-5">{{ $profile->name }} are not following any user.</div>
					@endif
				@endif
			</div>
		</div>
	</div>
@endsection
