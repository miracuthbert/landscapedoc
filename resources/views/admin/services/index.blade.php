@component('layouts.admin.master')

@section('title', 'Services')

@slot('page_theme_name') {{ 'items-list' }} @endslot

@section('content')

    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title"><i class="fa fa-cogs"></i> Services
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm rounded-s"> Add
                            New </a>
                        <!-- -->
                    </h3>
                    <p class="title-description"> List of services with: ratings, comments, category, etc... </p>
                </div>
            </div>
        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"><input type="text" class="form-control boxed rounded-s"
                                                placeholder="Search for..."> <span class="input-group-btn">
                            <button class="btn btn-secondary rounded-s" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span></div>
            </form>
        </div>
    </div>
    <div class="card items">
        <ul class="item-list striped">
            <li class="item item-list-header hidden-sm-down">
                <div class="item-row">
                    <div class="item-col fixed">
                        <label id="check-all-items">
                            <input type="checkbox" class="checkbox">
                        </label>
                    </div>
                    <div class="item-col item-col-header fixed item-col-img xs"></div>
                    <div class="item-col item-col-header item-col-title">
                        <div><span>Name</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"><span>Rating</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"><span>Sales</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"><span>Bookings</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"><span>Comments</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"><span>Category</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-date">
                        <div><span>Published</span></div>
                    </div>
                    <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                </div>
            </li>

            @foreach($services as $service)
                @include('admin.services.partials._service')
            @endforeach

        </ul>
        <hr>
        {{ $services->appends(['category' => $category])->links('layouts.admin.partials._pagination') }}
    </div>

@endsection

@endcomponent