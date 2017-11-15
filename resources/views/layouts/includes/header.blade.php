<header>			
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<div class="container">
			<a class="navbar-brand m-0 p-0" href="{{ route('welcome') }}">
				<img data-src="images/logo.png" class="img-50 lazy">
			</a>
			<div class="d-flex h-35">
				<form class="form-inline mr-3 d-none d-md-inline-flex" action="{{ route('search') }}" method="GET">
					<input class="form-control p-2 bd-none font-size-14 text-dark" type="text" placeholder="Search" name="term" id="search">
					<button class="text-default" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</form>
				<ul class="navbar-nav flex-row">
					@login
						<li class="nav-item mr-2 d-md-none">
							<a href="{{ route('search') }}" class="search-mobile nav-link text-default">
								<i class="fa fa-search font-size-20"></i>
							</a>
						</li>
						<li class="nav-item ml-2 mr-2 d-none d-md-block">
							<a class="nav-link text-success text-success-event" href="{{ route('posts.create') }}">Write a post</a>
						</li>
						<li class="nav-item nav-dropdown noti ml-2 mr-2">
							<a class="nav-link dropdown-toggle nav-link text-default notifications" data-toggle="dropdown">
								<i class="fa fa-bell-o font-size-20"></i>
								@unreadNotifications
									<span class="d-flex justify-content-center circle bg-success font-size-12 badge-noti">
										{{ auth()->user()->unreadNotifications->count() }}
									</span>
								@endunreadNotifications
							</a>
							<div class="dropdown-menu card-shadow m-0 p-0 bd-none font-size-14 notifications-feed">
								@notifications
									<div class="py-2 px-4">
										<span class="text-black">Notifications</span>
										<button class="float-right text-success hover-underline mark-all-as-read">Mark all as read</button>
									</div>
									<div class="dropdown-divider m-0"></div>
									@foreach (auth()->user()->notifications->slice(0, 5) as $notification)
										@if ($notification->unread())
											<div class="noti-item noti-unread">
										@else
											<div class="noti-item">
										@endif
												<a href="{!! $notification->data['path'] !!}" class="d-flex block py-2 px-4 text-dark notification" data-id="{{ $notification->id }}">
													<img src="{!! $notification->data['pathImage'] !!}" class="circle img-40">
													<div class="noti-info d-flex flex-column justify-content-center ml-3">
														<div>
															<span class="font-weight-bold">{!! $notification->data['name'] !!}</span>
															<span class="text-black">{!! $notification->data['content'] !!}</span>
														</div>
														<div class="text-default">
															@switch ($notification->type)
																@case ('App\Notifications\NotificationComment')
																	<i class="fa fa-comments text-success mr-1"></i>
																	@break
																@case ('App\Notifications\Follow')
																	<i class="fa fa-rss text-success mr-1"></i>
																	@break
																@default
																	<i class="fa fa-heart text-success mr-1"></i>
															@endswitch
															<span>{{ $notification->created_at->diffForHumans() }}</span>
														</div>
													</div>
												</a>
											</div>
									@endforeach
									<div class="py-2 text-center">
										<a href="javascript:;" class="text-success hover-underline">See all</a>
									</div>
								@else
									<div class="noti-item d-flex justify-content-center align-items-center h-60 bd-none">
										<span class="text-default">No notifications yet.</span>
									</div>
								@endnotifications
							</div>
						</li>
						<li class="nav-item nav-dropdown ml-2">
							<a class="dropdown-toggle block" data-toggle="dropdown">
								<img data-src="{{ auth()->user()->pathImage() }}" class="circle img-35 lazy">
							</a>
							<div class="dropdown-menu card-shadow py-2 bd-none font-size-14 user-action">
								<a href="javascript:;" class="dropdown-item py-2 px-4 bg-none text-black">Become a member</a>
								<div class="dropdown-divider"></div>
								<a href="{{ route('posts.create') }}" class="dropdown-item py-2 px-4 bg-none text-black">New post</a>
								<a href="{{ route('drafts') }}" class="dropdown-item py-2 px-4 bg-none text-black">Posts</a>
								<a href="javascript:;" class="dropdown-item py-2 px-4 bg-none text-black">Stats</a>
								<a href="{{ route('bookmark') }}" class="dropdown-item py-2 px-4 bg-none text-black">Bookmarks</a>
								<div class="dropdown-divider"></div>
								<a href="{{ auth()->user()->path() }}" class="dropdown-item py-2 px-4 bg-none text-black">Profile</a>
								<a href="javascript:;" class="dropdown-item py-2 px-4 bg-none text-black">Settings</a>
								<a href="javascript:;" class="dropdown-item py-2 px-4 bg-none text-black">Help</a>
								<a href="{{ route('signout') }}" class="dropdown-item py-2 px-4 bg-none text-black">Sign out</a>
							</div>
						</li>
					@else
						<li class="nav-item mr-2 d-md-none ">
							<a href="{{ route('search') }}" class="nav-link text-default">
								<i class="fa fa-search font-size-20"></i>
							</a>
						</li>
						<li class="nav-item ml-2">
							<button class="nav-link pr-0 text-success" data-toggle="modal" data-target="#modal-signin">Sign in / Sign up</button>
						</li>
					@endlogin
				</ul>
			</div>
		</div>
	</nav>
</header>
