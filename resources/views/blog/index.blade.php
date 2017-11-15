@extends('layouts.blog.master')

<!-- Page or file title -->
@section('title', 'Blog')

<!-- Page or file contents -->
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ config('app.name', 'LandscapeDoc') }} Blog</h1>
                        <span class="subheading">A collection of Posts and News on Landscaping</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @forelse($posts as $post)
                    <header class="masthead" style="background-image: url({{ URL::to($post->image) }})">
                        <div class="overlay"></div>
                    </header>
                    <div class="post-preview">
                        <a href="{{ route('blog.show', [$post]) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->excerpt }}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by
                            <a href="#">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
                            on {{ $post->created_at->toDayDateTimeString() }}</p>
                    </div>
                    <hr class="{{ $posts->total() == 1 || $posts->getCollection()->last()->id == $post->id ? 'd-none' : '' }}">
                @empty
                    <p class="lead text-center">No posts found.</p>
            @endforelse
            <!-- Pager -->
                <div class="clearfix">
                    {{ $posts->appends(['category' => $category, 'author' => $author])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
