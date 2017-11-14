@extends('layouts.app')
@section('title', 'Today’s top posts - Medium')
@section('content')
	<main>
		<section class="mt-40 mb-70">
			<h1 class="pb-5 font-size-32 font-weight-bold text-dark">Today’s top posts</h1>
			<h2 class="font-size-16 font-weight-normal text-dark">What’s trending on Medium right now.</h2>
		</section>
		<section>
			<div class="d-flex mb-30 bd-bottom">
				<div class="block-title pb-20">
					<span class="font-size-20 font-weight-bold text-dark">Featured</span>
				</div>
			</div>
			<div id="scroll-data" class="row mb-30">
				@include('pages.popular.data')
			</div>
		</section>
	</main>
	@include('layouts.includes.footer')
@endsection
