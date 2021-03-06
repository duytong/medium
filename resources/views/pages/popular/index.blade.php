@extends('layouts.app')
@section('title', 'Today’s top posts - Medium')
@section('content')
	<section class="my-5">
		<h1 class="pb-2 font-size-32 font-weight-bold text-dark">Today’s top posts</h1>
		<h2 class="font-size-16 font-weight-normal text-dark">What’s trending on Medium right now.</h2>
	</section>
	<section>
		<div class="d-flex mb-30 bd-bottom">
			<div class="block-title pb-3">
				<span class="font-size-20 font-weight-bold text-dark">Featured</span>
			</div>
		</div>
		<div id="scroll-data" class="row mb-5">
			@include('pages.popular.data')
		</div>
		<div class="d-flex justify-content-center">
			<div class="spinner mb-70" style="display: none"></div>
		</div>
	</section>
@endsection
