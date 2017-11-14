@extends('layout.app')
@section('content')
	<section>
		<div class="container-fluid">
			<nav class="navigation bg-light">
				<div class="container">
					<ul class="nav">
						<li class="nav-item sm-pr-16">
							<a class="text-dark " href="#">Home</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Popular on Twice</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Members only</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Technology</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Creativity</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Entrepreneurship</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Culture</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Self</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Politic</a>
						</li>
						<li class="nav-item sm-pr-16">
							<a class="text-default " href="#">Handpicked by Twice staff</a>
						</li>
						<li class="get-started pl-16 bg-light">
							<a href="" class="btn bg-success font-size-14 mr-8-0 sm-mr-12-0">Get started</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="container">
			<div class="promo-home">
				<div class="w-half md-w-full">
					<div class="promo-title text-dark xs-font-24">Interesting ideas that set your mind in motion.</div>
					<div class="promo-description text-dark xs-font-16">Hear directly from the people who know it best. From tech to politics to creativity and more — whatever your interest, we’ve got you covered.</div>
					<div class="d-flex align-items-center">
						<a href="" class="btn bg-success mr-8 font-size-14">Get started</a>
						<a href="" class="btn btn-outline-dark font-size-14">Learn more</a>
					</div>
				</div>
			</div>
			<div class="home-content">
				<div class="content-item">
					<div class="d-flex justify-content-between align-items-center bd-bottomottom mb-25">
						<span class="block-title pb-20">
							<a href="" class="font-size-20 font-weight-bold text-dark ">Today’s top posts</a>
						</span>
						<a href="" class="font-size-12 text-default  pb-20">
							<span class="text-uppercase mr-8">More</span>
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 mb-20">
							<div class="d-flex flex-column bd h-540">
								<a href="" class="block h-280" style="background: url(banner.png); background-position: 60% 47%;"></a>
								<div class="d-flex flex-column justify-content-between h-260 p-20">
									<div>
										<div class="font-size-12 pb-10">
											<i class="ti-lock mr-8"></i>
											<span>Twice members only</span>
										</div>
										<a href="">
											<h3 class="font-size-20 font-weight-bold text-dark line-height-1-2 pb-10">How to Refresh Your Brain to Restore High-Level Thinking</h3>
											<h4 class="font-size-14 font-weight-normal text-default line-height-1-4">He influenced Jobox-shadow and dreamed up a digital future designed for learning and thinking. Fifty years on, Alan Kay is still waiting for his…</h4>
										</a>
									</div>
									<div class="d-flex justify-content-between align-items-center pt-20">
										<div class="d-flex">
											<div class="pr-10">
												<img src="avatar.jpg" class="circle img-40">
											</div>
											<div class="d-flex flex-column justify-content-center">
												<a href="" class="font-size-12 text-dark hover-underline">Thomas Oppong</a>
												<span class="font-size-12">Sep 16 · 1 day ago</span>
											</div>
										</div>
										<button class="text-default "><i class="fa fa-bookmark-o font-size-20"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="row">
								@foreach ($posts as $post)
									<div class="col-lg-6 col-md-6 mb-20">
										<div class="d-flex flex-column h-260 bd">
											<a href="{{ $post->path() }}" class="block h-100" style="background: url(storage/posts/{{ $post->image  }}); background-position: 50% 50%;"></a>
											<div class="d-flex flex-column justify-content-between h-160 p-20">
												<a href="{{ $post->path() }}">
													<h3 class="font-size-20 font-weight-bold text-dark line-height-1-2 pb-10">
														{{ $post->title }}
													</h3>
													<h4 class="font-size-14 font-weight-normal text-default line-height-1-4 d-md-none pb-20">He influenced Jobox-shadow and dreamed up a digital future designed for learning and thinking. Fifty years on, Alan Kay is still waiting for his…</h4>
												</a>
												<div class="d-flex justify-content-between align-items-center">
													<div class="d-flex">
														<div class="pr-10">
															<img src="storage/users/{{ $post->author->avatar }}" class="circle img-40">
														</div>
														<div class="d-flex flex-column justify-content-center">
															<a href="" class="font-size-12 text-dark hover-underline">
																{{ $post->author->name }}
															</a>
															<span class="font-size-12">
																{{ date('M d', strtotime($post->created_at)) }} · {{ $post->created_at->diffForHumans() }}
															</span>
														</div>
													</div>
													<button class="text-default "><i class="fa fa-bookmark-o font-size-20"></i></button>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('layout.includes.footer')
@endsection
