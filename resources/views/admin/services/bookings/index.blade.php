@component('layouts.admin.master')

    @section('title', 'Services')

    @slot('page_theme_name') {{ 'items-list' }} @endslot

    @section('content')

        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"><i class="fa fa-calendar"></i> Bookings
                            <a href="{{ route('admin.services.edit',[$service]) }}" class="btn btn-primary btn-sm rounded-s">
                            Go to service</a>
                            <!-- -->
                        </h3>
                        <p class="title-description"> List of bookings for `{{ $service->name }}` service.</p>
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
                        <div class="item-col item-col-header item-col-category">
                            <div><span>Area</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"><span>Budget (KShs)</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Exp. Start</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Exp. D/line</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Conf. At</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Comp. At</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Booked At</span></div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                    </div>
                </li>

                @foreach($bookings as $booking)
                    @include('admin.services.bookings.partials._booking')
                @endforeach

            </ul>
            <hr>
            {{ $bookings->links('layouts.admin.partials._pagination') }}
        </div>

    @endsection

@endcomponent