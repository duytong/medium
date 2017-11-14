<div class="text-default font-size-12">
    <div class="pb-2">
        <div class="d-flex">
            <a href="{{ $randomPost->pathUser() }}">
                <img data-src="{{ $randomPost->pathImageUser() }}" class="circle img-50 lazy" alt="{{ $randomPost->user->name }}" title="{{ $randomPost->user->name }}">
            </a>
            <div class="d-flex flex-column justify-content-center pl-3">
                <h4 class="font-size-16 font-weight-bold">
                    <a href="{{ $randomPost->pathUser() }}" class="hover-underline text-dark" title="{{ $randomPost->user->name }}">
                        {{ $randomPost->user->name }}
                    </a>
                </h4>
                <div class="font-size-12 text-success">Medium member since {{ $randomPost->createdAtUser() }}</div>
            </div>
        </div>
        @if ($randomPost->user->summary != null)
            <div class="pt-2">{{ _substr($randomPost->user->summary, 100) }}</div>
        @endif
    </div>
    <div class="divider-popover my-2"></div>
    <div class="py-2">
        <div class="text-uppercase">Top posts</div>
        <ol>
            @foreach ($randomPost->user->posts->slice(0, 3) as $topPosts)
                <li>
                    <a href="{{ $topPosts->path() }}" class="text-dark hover-underline" title="{{ $topPosts->title }}">{{ $topPosts->title }}</a>
                </li>
            @endforeach
        </ol>
    </div>
    <div class="divider-popover my-2"></div>
    <div class="d-flex justify-content-between align-items-center pt-2">
        @if ($randomPost->user->follower()->count() > 0)
            <div class="font-size-14">Followed by <span class="text-dark">{{ $randomPost->user->follower()->count() }}</span> people</div>
        @else
            <div></div>
        @endif
        @login
            @if ($randomPost->user->id != auth()->id())
                @if (auth()->user()->isFollowing($randomPost->user)) 
                    <button id="detach" class="btn bg-success btn-shadow font-size-12" data-id={{ $randomPost->user->id }}>Following</button>
                @else
                    <button id="attach" class="btn btn-success font-size-12" data-id={{ $randomPost->user->id }}>Follow</button>
                @endif
            @endif
        @else
            <button class="btn btn-success font-size-12" data-toggle="modal" data-target="#modal-signin">Follow</button>
        @endlogin
    </div>
</div>
