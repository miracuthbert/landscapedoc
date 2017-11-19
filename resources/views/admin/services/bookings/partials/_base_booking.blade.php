<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="service_ids" value="{{ $booking->id }}">
            </label>
        </div>
        <div class="item-col fixed item-col-img xs">
            <a href="{{ route('admin.services.bookings.edit', [$service, $booking]) }}">
                <div class="item-img xs rounded"
                     style="background-image: url({{ !empty($booking->user->avatar) ? url($booking->user->avatar) : '' }})"></div>
            </a>
        </div>
        <div class="item-col item-col-title no-overflow">
            <div>
                <a href="{{ route('admin.services.bookings.edit', [$service, $booking]) }}" class="">
                    <h4 class="item-title no-wrap"> {{ $booking->user->name() }} </h4>
                </a>
            </div>
        </div>
        <div class="item-col item-col-category">
            <div class="item-heading">Area</div>
            <div>
                <div class="small"> {{ $booking->area->name }} </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Budget</div>
            <div class="no-overflow">
                <div class="small"> {{ $booking->expBudget() }} 0</div>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Exp. Start</div>
            <div>
                <div class="small"> {{ $booking->expStartDate() }}  </div>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Exp. End</div>
            <div>
                <div class="small"> {{ $booking->expEndDate() }}  </div>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Confirmed At</div>
            <div class="small"></div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Completed At</div>
            <div class="small"></div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Booked At</div>
            <div class="small"> {{ $booking->created_at->diffForHumans() }}</div>
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
                               data-target="#confirm-modal-{{ $booking->id }}" title="Reject/Cancel Booking">
                                <i class="fa fa-remove"></i>
                            </a>

                            <form id="booking-destroy-{{ $booking->id }}-form"
                                  action="{{ route('admin.services.bookings.destroy', [$service, $booking]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$booking->id}", 'title' => "Cancel Booking Confirmation", 'message' => "Are you sure you want to cancel {$booking->user->name()}'s booking?", 'action' => "booking-destroy-{$booking->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.services.bookings.edit', [$service, $booking]) }}"
                               title="Update/Confirm Booking">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>