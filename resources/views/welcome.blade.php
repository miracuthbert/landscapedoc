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
                        <h1>{{ config('app.name', 'LandscapeDoc') }}</h1>
                        <span class="subheading">Good Life Equals Better Landscape.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="services">
        <div class="container">
            <div class="row">
                @forelse($services as $service)
                    <div class="col-lg-4">
                        <div class="card">
                            <img src="{{ url($service->image) }}" alt="{{ $service->name }} image"
                                 class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">{{ $service->name }}</h4>
                                <p class="card-text">{{ $service->overview }}</p>
                                <a class="card-link btn btn-outline-primary mr-auto"
                                   href="{{ route('services.show', [$service]) }}" role="button">View</a>
                                <a role="button" href="{{ route('service.booking.create', [$service]) }}"
                                   class="card-link btn btn-success">
                                    <i class="fa-fa-calendar-plus"></i> Book now!
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="lead text-center">Coming Soon.</p>
                @endforelse
            </div>
        </div>
    </div>

    </div><!-- /#services -->
@endsection

{{--<div id="testimonials">--}}
{{--<h3>Testimonials</h3>--}}
{{--<div class="container">--}}
{{--<div id="carouselTestimonials" class="carousel slide" data-ride="carousel">--}}
{{--<div class="carousel-inner">--}}
{{--<div class="carousel-item active">--}}
{{--<img class="img-circle mx-auto d-block" src="https://robohash.org/MRJ.png?set=set4"--}}
{{--alt="Jane Doe">--}}
{{--<h4>Jane Doe</h4>--}}
{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
{{--</div>--}}
{{--<div class="carousel-item">--}}
{{--<img class="img-circle mx-auto d-block" src="https://robohash.org/9VK.png?set=set4"--}}
{{--alt="John Doe">--}}
{{--<h4>John Doe</h4>--}}
{{--<p>Accusantium aliquid aspernatur at, delectus deserunt dolorem eos fugiat hic neque</p>--}}
{{--</div>--}}
{{--<div class="carousel-item">--}}
{{--<img class="img-circle mx-auto d-block" src="https://robohash.org/P3O.png?set=set4"--}}
{{--alt="John Johns">--}}
{{--<h4>John Johns</h4>--}}
{{--<p>Perspiciatis quaerat qui recusandae--}}
{{--repudiandae suscipit vel? Adipisci minima soluta tempore?</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--<a class="carousel-control-prev" href="#carouselTestimonials" role="button" data-slide="prev">--}}
{{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--<span class="sr-only">Previous</span>--}}
{{--</a>--}}
{{--<a class="carousel-control-next" href="#carouselTestimonials" role="button" data-slide="next">--}}
{{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--<span class="sr-only">Next</span>--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
