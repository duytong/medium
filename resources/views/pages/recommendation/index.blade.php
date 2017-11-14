@extends('layouts.app')
@section('title', 'You might like - Medium')
@section('content')
	<main>
		<section class="mt-40 mb-70">
			<h1 class="pb-5 font-size-32 font-weight-bold text-dark">You might like</h1>
			<h2 class="font-size-16 font-weight-normal text-dark">For you.</h2>
		</section>
		<section>
			<div class="d-flex mb-30 bd-bottom">
				<div class="block-title pb-20">
					<span class="font-size-20 font-weight-bold text-dark">Featured</span>
				</div>
			</div>
			<div id="scroll-data" class="row mb-30">
				@include('pages.recommendation.data')
			</div>
		</section>
	</main>
	@include('layouts.includes.footer')
@endsection
