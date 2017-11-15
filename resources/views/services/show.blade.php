@extends('layouts.blog.master')

<!-- Page or file title -->
@section('title', "{$service->name}")

<!-- Page or file contents -->
@section('content')
    <!-- Page Header -->
    <header class="masthead"style="background-image: url({{ !empty($service->image) ? url($service->image) : '' }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $service->name }}</h1>
                        <h2 class="subheading">{{ $service->overview }}</h2>
                        <p class="meta">In {{ $service->category->name }}</p>
                        <p class="meta">Starting Fee: KShs. {{ $service->price() }}</p>
                        <p class="meta">
                            Locations:
                            @foreach($service->areas as $area)
                                <span class="badge badge-pill badge-primary">{{ $area->name }}</span>
                            @endforeach
                        </p>
                        <p class="meta">
                            <a href="{{ route('service.booking.create', [$service]) }}" class="btn btn-success btn-lg">
                                <i class="fa-fa-calendar-plus"></i> Book now!
                            </a>
                        </p>
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
                    {!! $service->body !!}
                </div>
            </div>
        </div>
    </article>
@endsection
