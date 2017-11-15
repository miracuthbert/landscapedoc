<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="category_ids[]" value="{{ $area->id }}">
            </label>
        </div>
        <div class="item-col fixed pull-left item-col-title">
            <div class="item-heading">Title</div>
            <div>
                <a href="{{ route('admin.areas.edit', [$area]) }}" class="">
                    <h4 class="item-title"> {{ $area->name }}</h4>
                </a>
            </div>
        </div>
        <div class="item-col item-col-category">
            <div class="item-heading">Slug</div>
            <div><a href="{{ route('admin.posts.index', ['area' => $area]) }}">{{ $area->slug }}</a></div>
        </div>
        {{--<div class="item-col item-col-stats no-overflow">--}}
            {{--<div class="item-heading">Services</div>--}}
            {{--<div class="no-overflow">--}}
                {{--<div class="item-stats">--}}
                    {{--<span class="badge badge-pill badge-primary">{{ $area->services->count() }}</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Status</div>
            <div class="no-overflow">
                <a href="">{{ $area->usable ? 'Active' : 'Disabled' }}</a>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Added</div>
            <div class="no-overflow">{{ $area->created_at->diffForHumans() }}</div>
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
                               data-target="#confirm-modal-{{ $area->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="area-destroy-{{ $area->id }}-form"
                                  action="{{ route('admin.areas.destroy', [$area]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$area->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$area->name}?", 'action' => "area-destroy-{$area->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.areas.edit', [$area]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>