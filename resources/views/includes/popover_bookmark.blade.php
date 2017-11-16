<div class="text-default font-size-12">
    <div class="pb-2">
        <div class="d-flex">
            <a href="{{ $bookmark->bookmarkable->user->path() }}">
                <img data-src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="circle img-50 lazy" alt="{{ $bookmark->bookmarkable->user->name }}" title="{{ $bookmark->bookmarkable->user->name }}">
            </a>
            <div class="d-flex flex-column justify-content-center pl-3">
                <h4 class="font-size-16 font-weight-bold">
                    <a href="{{ $bookmark->bookmarkable->user->path() }}" class="hover-underline text-dark" title="{{ $bookmark->bookmarkable->user->name }}">
                        {{ $bookmark->bookmarkable->user->name }}
                    </a>
                </h4>
                <div class="font-size-12 text-success">Medium member since {{ $bookmark->bookmarkable->user->createdAt() }}</div>
            </div>
        </div>
        @if ($bookmark->bookmarkable->user->summary != null)
            <div class="pt-2">{{ _substr($bookmark->bookmarkable->user->summary, 100) }}</div>
        @endif
    </div>
    @if ($bookmark->bookmarkable->user->posts->count() > 0)
        <div class="divider-popover my-2"></div>
        <div class="py-2">
            <div class="text-uppercase">Top posts</div>
            <ol>
                @foreach ($bookmark->bookmarkable->user->posts->slice(0, 3) as $topPosts)
                    <li>
                        <a href="{{ $topPosts->path() }}" class="text-dark hover-underline" title="{{ $topPosts->title }}">{{ $topPosts->title }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
    <div class="divider-popover my-2"></div>
    <div class="d-flex justify-content-between align-items-center pt-2">
        @if ($bookmark->bookmarkable->user->follower()->count() > 0)
            <div class="font-size-14">Followed by <span class="text-dark">{{ $bookmark->bookmarkable->user->follower()->count() }}</span> people</div>
        @else
            <div></div>
        @endif
        @if ($bookmark->bookmarkable->user->id != auth()->id())
            @if (auth()->user()->isFollowing($bookmark->bookmarkable->user)) 
                <button id="detach" class="btn bg-success btn-shadow font-size-12" data-id={{ $bookmark->bookmarkable->user->id }}>Following</button>
            @else
                <button id="attach" class="btn btn-success font-size-12" data-id={{ $bookmark->bookmarkable->user->id }}>Follow</button>
            @endif
        @endif
    </div>
</div>
