@extends('layouts.app')

<!-- Page or file title -->
@section('title', "{$service->name} Booking")

<!-- Page or file contents -->
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $service->name }} Booking - Step 1</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST"
                          action="{{ route('service.booking.store', [$service]) }}">
                        {{ csrf_field() }}

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
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
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
                                          class="form-control"></textarea>

                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- /.form-group -->

                        @guest
                            <hr>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <h3>User details</h3>
                                    <span class="help-block">Your details are used confirm and contact you on booking completion</span>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">{{ '@' }}</div>
                                        <input id="username" type="text" class="form-control" name="username"
                                               value="{{ old('username') }}" required autofocus>
                                    </div>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Mobile Phone No.</label>

                                <div class="col-md-6">
                                    <input id="phone" type="number" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>
                        @endguest

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save and proceed to budget <i class="fa fa-chevron-right"></i>
                                </button>
                                @guest
                                    <span class="help-block">You will be redirected to login first before setting the budget</span>
                                @endguest
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
