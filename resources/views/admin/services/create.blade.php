@component('layouts.admin.master')

    @section('title', 'Add New Service')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-cog"></i> Add New Service</h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.services.store') }}">
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 form-control-label text-xs-right">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control boxed" id="name"
                               placeholder="Enter Service Name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="price" class="col-sm-2 form-control-label text-xs-right">Price</label>
                    <div class="col-sm-10">
                        <input type="text" name="price" class="form-control boxed" id="price"
                               placeholder="Enter Service Price" value="{{ old('price') }}" autofocus>
                        @if ($errors->has('price'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="body" class="col-sm-2 form-control-label text-xs-right">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                               <span class="input-group-btn">
                                 <button type="button" id="lfm" data-input="thumbnail" data-preview="holder"
                                         class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </span>
                            <input id="thumbnail" class="form-control" type="text" name="image"
                                   value="{{ old('image') }}">
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ old('image') }}">
                        @if ($errors->has('image'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="overview" class="col-sm-2 form-control-label text-xs-right">Overview</label>
                    <div class="col-sm-10">
                                <textarea name="overview" rows="3" class="form-control boxed" id="overview"
                                          placeholder="Enter Service Overview (summary)"
                                          maxlength="50">{{ old('overview') }}</textarea>
                        @if ($errors->has('overview'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('overview') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="body" class="col-sm-2 form-control-label text-xs-right">Body</label>
                    <div class="col-sm-10">
                            <textarea name="body" rows="5" class="form-control boxed tm_std" id="body"
                                      placeholder="Enter Service Details">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Category</label>
                    <div class="col-sm-10">
                        <select name="category" id="" class="form-control custom-select">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    @if($category->ancestors->count())
                                        ({{ implode(' > ', $category->ancestors->pluck('name')->toArray()) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Service Areas</label>
                    <div class="col-sm-10">
                        @foreach($areas->chunk(3) as $locations)
                            <div class="row">
                                @foreach($locations as $area)
                                    <div class="col-sm-4">
                                        <label>
                                            <input class="checkbox" name="areas[]" type="checkbox"
                                                   value="{{ $area->id }}" {{--{{ old('status') == 0 ? 'checked' : '' }}--}}>
                                            <span>{{ $area->name }}
                                                @if($area->ancestors->count())
                                                    ({{ implode(' > ', $area->ancestors->pluck('name')->toArray()) }})
                                                @endif
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                            @if ($errors->has('areas'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('areas') }}</strong>
                                    </span>
                            @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Status</label>
                    <div class="col-sm-10">
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="0" {{ old('status') == 0 ? 'checked' : '' }}>
                            <span>Draft</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                            <span>Live</span>
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

    @section('scripts')
        <script>
            $('#lfm').filemanager('image');
        </script>
    @endsection

@endcomponent