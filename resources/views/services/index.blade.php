@extends('layouts.blog.master')

<!-- Page or file title -->
@section('title', 'Services')

<!-- Page or file contents -->
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Services</h1>
                        <span class="subheading">A List Of Landscaping Services</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @forelse($services as $service)
                    <div class="post-preview">
                        <div class="img-fluid" style="background: no-repeat center center; background-color: #868e96; background-attachment: scroll; background-image: url({{ !empty($service->image) ? url($service->image) : '' }})">
                        </div>
                        <a href="{{ route('services.show', [$service]) }}">
                            <h2 class="post-title">
                                {{ $service->name }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $service->overview }}
                            </h3>
                        </a>
                        <p class="post-meta">Starting Fee: KShs. {{ $service->price() }}</p>
                        <p class="post-meta">
                            Locations:
                            @foreach($service->areas as $area)
                                <span class="badge badge-pill badge-primary">{{ $area->name }}</span>
                            @endforeach
                        </p>
                        <p>
                            <a role="button" href="{{ route('service.booking.create', [$service]) }}" class="btn btn-success btn-lg">
                                <i class="fa-fa-calendar-plus"></i> Book now!
                            </a>
                        </p>
                    </div>
                    <hr class="{{ $services->total() == 1 || $services->getCollection()->last()->id == $service->id ? 'd-none' : '' }}">
                @empty
                    <p class="lead text-center">Coming Soon.</p>
            @endforelse
            <!-- Pager -->
                <div class="clearfix">
                    {{ $services->appends(['category' => $category])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
