@extends('layouts.blog.master')

<!-- Page or file title -->
@section('title', "{$post->title}")

<!-- Page or file contents -->
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ URL::to($post->image) }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->excerpt }}</h2>
                        <span class="meta">Posted by
                <a href="#">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
                on {{ $post->created_at->toDayDateTimeString() }}</span>
                        <span class="meta">Posted in {{ $post->category->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </article>
@endsection
