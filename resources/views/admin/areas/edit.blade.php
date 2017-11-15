@component('layouts.admin.master')

    @section('title', 'Edit Area')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-edit"></i> Edit Area <span class="sparkline bar"
                                                                            data-type="bar"></span></h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.areas.update', [$area]) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 form-control-label text-xs-right">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control boxed" id="name"
                               placeholder="Enter Area Name" value="{{ old('name', $area->name) }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Parent area</label>
                    <div class="col-sm-10">
                        <select name="parent" id="" class="form-control custom-select">
                            <option value=""></option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}"
                                        {{ old('parent', $area->parent_id) == $area->id ? 'selected' : '' }}>
                                    {{ $area->name }}
                                    @if($area->ancestors->count())
                                        ({{ implode(' > ', $area->ancestors->pluck('name')->toArray()) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('parent') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Status</label>
                    <div class="col-sm-10">
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="0" {{ old('status', $area->usable) == 0 ? 'checked' : '' }}>
                            <span>Disabled</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ old('status', $area->usable) == 1 ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                        @if ($errors->has('status'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.card -->
        </form>
    @endsection

@endcomponent