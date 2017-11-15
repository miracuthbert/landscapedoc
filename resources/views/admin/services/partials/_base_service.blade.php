<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="service_ids" value="{{ $service->id }}">
            </label>
        </div>
        <div class="item-col fixed item-col-img xs">
            <a href="">
                <div class="item-img xs rounded"
                     style="background-image: url({{ !empty($service->image) ? url($service->image) : '' }})"></div>
            </a>
        </div>
        <div class="item-col item-col-title no-overflow">
            <div>
                <a href="{{ route('admin.services.edit', [$service]) }}" class="">
                    <h4 class="item-title no-wrap"> {{ $service->name }} </h4>
                </a>
            </div>
        </div>
        {{ $owner or '' }}
        <div class="item-col item-col-stats">
            <div class="item-heading">Rating</div>
            <div class="no-overflow">
                <div class="item-stats"> {{--{{ $service->averageRating() }} by {{ $service->ratings->count() }}--}} 0 </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Sales</div>
            <div class="no-overflow">
                <div class="item-stats"> {{--{{ $service->sales() }}--}} 0 </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Bookings</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ $service->bookings->count() }}  </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Comments</div>
            <div class="no-overflow">
                <div class="item-stats"> {{--{{ $service->comments->count() }}--}} 0 </div>
            </div>
        </div>
        {{ $category or '' }}
        <div class="item-col item-col-date">
            <div class="item-heading">Published</div>
            <div> {{ $service->created_at->diffForHumans() }}</div>
        </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown">
                <a class="item-actions-toggle-btn">
                    <span class="inactive">
                        <i class="fa fa-cog"></i>
                    </span>
                    <span class="active">
                        <i class="fa fa-chevron-circle-right"></i>
                    </span>
                </a>
                <div class="item-actions-block">
                    <ul class="item-actions-list">
                        <li>
                            <a class="remove" href="#" data-toggle="modal"
                               data-target="#confirm-modal-{{ $service->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="services-destroy-{{ $service->id }}-form"
                                  action="{{ route('admin.services.destroy', [$service]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$service->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$service->name}?", 'action' => "services-destroy-{$service->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.services.edit', [$service]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.comments.index', [$service]) }}">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>