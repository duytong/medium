@extends('layouts.app')
@section('title', 'Explore topics - Medium')
@section('content')
	<h1 class="my-5 font-size-32 font-weight-bold text-dark">Explore topics</h1>
	<div id="scroll-data">
		@include('topics.data')
	</div>
	<div class="d-flex justify-content-center">
		<div class="spinner mb-70" style="display: none"></div>
	</div>
@endsection
