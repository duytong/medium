@extends('layouts.app')
@section('title', $topic->name . ' - Medium')
@section('content')
	<section class="my-5">
		<div class="d-flex mb-5">
			<div class="d-flex flex-column w-full">
				<div class="d-flex justify-content-between align-items-center">
					<span class="font-size-16">Handpicked by Medium Staff</span>
					@login
						@if (auth()->user()->subscribed($topic))
							<button id="detach" class="btn bg-success box-shadow topic" data-id="{{ $topic->id }}">Subscribed</button>
						@else
							<button id="attach" class="btn btn-success topic" data-id="{{ $topic->id }}">Subscribe</button>
						@endif
					@else
						<button class="btn btn-success" data-toggle="modal" data-target="#modal-signin">Subcribe</button>
					@endlogin
				</div>
				<h1 class="mb-2 font-size-32 font-weight-bold text-dark">{{ $topic->name }}</h1>
				<h2 class="font-size-20 text-black">{{ $topic->overview }}</h2>
			</div>
		</div>
		<div class="d-flex font-size-16">
			<span class="mr-20">Related topics</span>
			@foreach ($relatedTopics as $key => $relatedTopic)
				@if ($key < 2)
					<a href="{{ $relatedTopic->path() }}" class="text-dark hover-underline" title="{{ $relatedTopic->name }}">
						{{ $relatedTopic->name }}
					</a>
					<span class="mr-1">,</span>
				@else
					<a href="{{ $relatedTopic->path() }}" class="text-dark hover-underline" title="{{ $relatedTopic->name }}">
						{{ $relatedTopic->name }}
					</a>
				@endif
			@endforeach
		</div>
	</section>
	<section>
		<div class="d-flex bd-bottom mb-30">
			<div class="block-title pb-3">
				<span class="font-size-20 font-weight-bold text-dark">Featured</span>
			</div>
		</div>
		<div id="scroll-data" class="row mb-5">
			@include('topics.posts.data')
		</div>
		<div class="d-flex justify-content-center">
			<div class="spinner mb-70"></div>
		</div>
	</section>
@endsection
