@extends('layouts.app')
@section('title','Your Medium private bookmarks')
@section('content')
	<main>
		<section class="mt-40 mb-70">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					@if ($bookmarks->count() > 1)
						<h1 class="mb-3 font-size-32 font-weight-normal text-dark">Stories you’ve saved. Remember these?</h1>
					@else
						<h1 class="p-3 bd text-center font-size-32 font-weight-normal text-dark">No bookmarks yet.</h1>
					@endif
					<div id="scroll-data">
						@include('users.bookmarks.data')
					</div>
				</div>
			</div>
		</section>
	</main>
	@include('layouts.includes.footer')
@endsection
