@extends('layouts.app')

<!-- Page or file title -->
@section('title', "Edit {$service->name} Booking")

<!-- Page or file contents -->
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $service->name }} Booking - Step 2</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST"
                          action="{{ route('service.booking.update', [$service, $booking]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <input type="hidden" name="service" id="service" value="{{ $service->id }}">

                        <div class="form-group">
                            <label for="service" class="col-md-4 control-label">Service</label>

                            <div class="col-md-6">
                                <p class="form-control-static">{{ $service->name }}</p>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="details" class="col-md-4 control-label">Area</label>

                            <div class="col-md-6">
                                <select name="area" id="area" class="form-control">
                                    <option value="">Choose an area near you</option>
                                    @foreach($service->areas as $area)
                                        <option value="{{ $area->id }}" {{ $booking->area_id == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                            <label for="details" class="col-md-4 control-label">Details</label>

                            <div class="col-md-6">
                                <textarea name="details" id="details" cols="30" rows="5"
                                          class="form-control">{{ old('details', $booking->details) }}</textarea>

                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                            <label for="budget" class="col-md-4 control-label">Budget</label>

                            <div class="col-md-6">
                                <input type="text" name="budget" class="form-control" id="budget"
                                       value="{{ old('budget', $booking->expBudget()) }}">

                                <span class="help-block">Your budget</span>

                                @if ($errors->has('budget'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('budget') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group{{ $errors->has('starts_at') ? ' has-error' : '' }}">
                            <label for="starts_at" class="col-md-4 control-label">Starts At (Date and Time)</label>

                            <div class="col-md-6">
                                <input type="text" name="starts_at" class="form-control" id="starts_at"
                                       value="{{ old('starts_at', $booking->expStart()) }}">

                                <span class="help-block">Project start time</span>

                                @if ($errors->has('starts_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('starts_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group{{ $errors->has('ends_at') ? ' has-error' : '' }}">
                            <label for="ends_at" class="col-md-4 control-label">Ends At (Date and Time)</label>

                            <div class="col-md-6">
                                <input type="text" name="ends_at" class="form-control" id="ends_at"
                                       value="{{ old('ends_at',$booking->expEnd()) }}">

                                <span class="help-block">Project deadline</span>

                                @if ($errors->has('ends_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ends_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<label for="" class="control-label"></label>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<label for="" class="control-label"></label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div><!-- /.form-group -->--}}
                    </form>
                </div>
            </div>
        </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
@endsection
