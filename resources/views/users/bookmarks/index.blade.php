@extends('layouts.app')
@section('title','Your Medium private bookmarks')
@section('content')
	<div class="mt-5">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				@if ($bookmarks->count() > 0)
					<h1 class="mb-3 font-size-32 font-weight-normal text-dark">Stories you’ve saved. Remember these?</h1>
				@else
					<h1 class="p-3 card-shadow text-center font-size-32 font-weight-normal text-dark">No bookmarks yet.</h1>
				@endif
				<div id="scroll-data">
					@include('users.bookmarks.data')
				</div>
				<div class="d-flex justify-content-center">
					<div class="spinner mb-5" style="display: none"></div>
				</div>
			</div>
		</div>
	</div>
@endsection
