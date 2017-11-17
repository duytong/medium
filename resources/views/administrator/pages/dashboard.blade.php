@extends('administrator.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">Categories</h4>
                                    <br>
                                    <span class="m-widget24__desc">Total categories</span>
                                    <span class="m-widget24__stats m--font-brand">{{ $categories->count() }}</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">Topics</h4>
                                    <br>
                                    <span class="m-widget24__desc">Total topics</span>
                                    <span class="m-widget24__stats m--font-info">{{ $topics->count() }}</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">Posts</h4>
                                    <br>
                                    <span class="m-widget24__desc">Total posts</span>
                                    <span class="m-widget24__stats m--font-danger">{{ $posts->count() }}</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!-- Begin:: New users-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">Users</h4>
                                    <br>
                                    <span class="m-widget24__desc">Total users</span>
                                    <span class="m-widget24__stats m--font-success">{{ $users->count() }}</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($posts->slice(0, 3) as $post)
                    <div class="col-xl-4">
                        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height">
                            <div class="m-portlet__body">
                                <div class="m-widget19">
                                    <div class="m-widget19__content">
                                        <div class="m-widget19__header">
                                            <div class="m-widget19__user-img">
                                                <img class="m-widget19__img" src="{{ $post->userImagePath() }}">
                                            </div>
                                            <div class="m-widget19__info">
                                                <span class="m-widget19__username">{{ $post->user->name }}</span>
                                                <br>
                                                <span class="m-widget19__time">{{ $post->createdAt() }}</span>
                                            </div>
                                        </div>
                                        <h5 class="m-widget19__title">{{ _substr($post->title, 50) }}</h5>
                                        <div class="m-widget19__body">{!! _substr($post->body, 200) !!}</div>
                                    </div>
                                    <div class="m-widget19__action">
                                        <a href="{{ $post->path() }}" class="btn m-btn--pill btn-outline-info btn-sm">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <i class="flaticon-users mr-3"></i>New users
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_widget4_tab1_content">
                                    <div class="m-widget4">
                                        @foreach ($users->slice(0, 5) as $key => $user)
                                                <div class="m-widget4__item">
                                                    <div class="m-widget4__img m-widget4__img--pic">
                                                        <img src="{{ $user->pathImage() }}">
                                                    </div>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">{{ $user->name }}</span>
                                                        <br>
                                                        <span class="m-widget4__sub">{{ $user->email }}</span>
                                                    </div>
                                                    <div class="m-widget4__ext">
                                                        <a href="{{ $user->path() }}" class="btn m-btn--pill btn-outline-primary btn-sm">Profile</a>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <i class="flaticon-web mr-3"></i>Lastest comments
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body d-flex align-items-center">
                            <div class="m-widget3">
                                @foreach ($comments as $comment)
                                    <div class="m-widget3__item">
                                        <div class="m-widget3__header mb-2">
                                            <div class="m-widget3__user-img mb-0">
                                                <img class="m-widget3__img" src="{{ $comment->userImagePath() }}">
                                            </div>
                                            <div class="m-widget3__info">
                                                <span class="m-widget3__username">{{ $comment->user->name }}</span>
                                                <br>
                                                <span class="m-widget3__time">{{ $comment->createdAtShort() }}</span>
                                            </div>
                                            <a href="{{ $comment->path() }}" class="btn m-btn--pill btn-outline-danger btn-sm">View</a>
                                        </div>
                                        <div class="m-widget3__body">
                                            <p class="m-widget3__text">{{ _substr($comment->body, 100) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection