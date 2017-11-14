<div class="font-size-12 text-default">
    <div class="pb-5">
        <div class="d-flex">
            <a href="{{ $bookmark->bookmarkable->user->path() }}">
                <img src="{{ $bookmark->bookmarkable->user->pathImage() }}" class="circle img-48 sub-author" alt="{{ $bookmark->bookmarkable->user->name }}" title="{{ $bookmark->bookmarkable->user->name }}">
            </a>
            <div class="d-flex flex-column pl-10">
                <h4 class="font-18 font-weight-bold">
                    <a href="{{ $bookmark->bookmarkable->user->path() }}" class="hover-underline text-dark sub-author" title="{{ $bookmark->bookmarkable->user->name }}">
                        {{ $bookmark->bookmarkable->user->name }}
                    </a>
                </h4>
                <div class="font-13 text-success">Medium member since {{ $bookmark->bookmarkable->user->createdAt() }}</div>
            </div>
        </div>
        <div>{{ _substr($bookmark->bookmarkable->user->summary, 100) }}</div>
    </div>
    @if ($bookmark->bookmarkable->user->posts->count() > 0)
        <div class="bd-bottomottom mr-8-0"></div>
        <div class="pt-6 pb-5">
            <div class="text-uppercase">Top posts</div>
            <ol>
                @foreach ($bookmark->bookmarkable->user->posts as $key => $topposts)
                    @if ($key < 3)
                        <li>
                            <a href="{{ $topposts->path() }}" class="text-dark hover-underline" title="{{ $topposts->title }}">
                                {{ $topposts->title }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </div>
    @endif
    <div class="bd-bottomottom mr-8-0"></div>
    <div class="d-flex justify-content-between align-items-center pt-6">
        <div class="font-size-14">Followed by <span class="cl-medium">14</span> people</div>
        <button class="btn btn-success p-6-12 font-size-12">Follow</button>
    </div>
</div>