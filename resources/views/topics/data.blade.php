@foreach ($categories as $category)
	<div class="mb-5 last-page" data-page="{{ $lastPage }}">
		<div class="d-flex mb-30 bd-bottom">
			<div class="block-title pb-3">
				<h2 class="font-size-20 font-weight-bold text-dark">{{ $category->name }}</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="row">
					@foreach ($topics as $topic)
						<div class="col-lg-4 col-md-6 mb-30">
							<div class="d-flex flex-column align-items-center bd-radius-2 card-shadow">
								<div class="d-flex justify-content-between align-items-center w-full p-3">
									<a href="{{ $topic->path() }}" class="text-dark" title="{{ $topic->name }}">
										<h3 class="font-size-20 font-weight-bold">{{ $topic->name }}</h3>
									</a>
									@login
										@if (auth()->user()->subscribed($topic))
											<button id="detach" class="btn btn-action btn-shadow circle bg-dark-blue star topic" data-id="{{ $topic->id }}">
												<i class="fa fa-star"></i>
											</button>
										@else
											<button id="attach" class="btn btn-action btn-star circle text-dark-blue star topic" data-id="{{ $topic->id }}">
												<i class="fa fa-star"></i>
											</button>
										@endif
									@else
										<button class="btn btn-action btn-star circle text-dark-blue star">
											<i class="fa fa-star"></i>
										</button>
									@endlogin
								</div>
								<a href="{{ $topic->path() }}" class="w-full" title="{{ $topic->name }}">
									@if (file_exists($topic->pathImage()))
	                                    <div class="h-180 m-3 bg-position-center lazy" data-src="{{ $topic->pathImage() }}"></div>
	                                @else
	                                    <div class="h-180 m-3 img-error lazy" data-src="{{ $topic->pathImageError() }}"></div>
	                                @endif
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endforeach
