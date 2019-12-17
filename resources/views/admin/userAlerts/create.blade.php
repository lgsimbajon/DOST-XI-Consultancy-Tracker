@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.userAlert.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.user-alerts.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('alert_text') ? 'has-error' : '' }}">
                            <label for="alert_text">{{ trans('cruds.userAlert.fields.alert_text') }}*</label>
                            <input type="text" id="alert_text" name="alert_text" class="form-control" value="{{ old('alert_text', isset($userAlert) ? $userAlert->alert_text : '') }}" required>
                            @if($errors->has('alert_text'))
                                <p class="help-block">
                                    {{ $errors->first('alert_text') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.alert_text_helper') }}
                            </p>
                            <input type="hidden" value="" name="alert_link" id="alert_link" class="form-control">
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label for="start_date">{{ trans('cruds.userAlert.fields.start_date') }}*</label>
                            <input type="text" id="start_date" name="start_date" class="form-control date" value="{{ old('start_date', isset($userAlert) ? $userAlert->start_date : '') }}" required>
                            @if($errors->has('start_date'))
                                <p class="help-block">
                                    {{ $errors->first('start_date') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.start_date_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                            <label for="start_time">{{ trans('cruds.userAlert.fields.start_time') }}*</label>
                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="{{ old('start_time', isset($userAlert) ? $userAlert->start_time : '') }}" required>
                            @if($errors->has('start_time'))
                                <p class="help-block">
                                    {{ $errors->first('start_time') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.start_time_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label for="end_date">{{ trans('cruds.userAlert.fields.end_date') }}*</label>
                            <input type="text" id="end_date" name="end_date" class="form-control date" value="{{ old('end_date', isset($userAlert) ? $userAlert->end_date : '') }}" required>
                            @if($errors->has('end_date'))
                                <p class="help-block">
                                    {{ $errors->first('end_date') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.end_date_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                            <label for="end_time">{{ trans('cruds.userAlert.fields.end_time') }}*</label>
                            <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="{{ old('end_time', isset($userAlert) ? $userAlert->end_time : '') }}" required>
                            @if($errors->has('end_time'))
                                <p class="help-block">
                                    {{ $errors->first('end_time') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.end_time_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('users') ? 'has-error' : '' }}">
                            <label for="user">{{ trans('cruds.userAlert.fields.user') }}
                                <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                            <select name="users[]" id="users" class="form-control select2" multiple="multiple">
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || isset($userAlert) && $userAlert->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('users'))
                                <p class="help-block">
                                    {{ $errors->first('users') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.user_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('activity_venue') ? 'has-error' : '' }}">
                            <label for="activity_venue">{{ trans('cruds.userAlert.fields.activity_venue') }}*</label>
                            <input type="text" id="activity_venue" name="activity_venue" class="form-control" value="{{ old('activity_venue', isset($userAlert) ? $userAlert->activity_venue : '') }}" required>
                            @if($errors->has('activity_venue'))
                                <p class="help-block">
                                    {{ $errors->first('activity_venue') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.userAlert.fields.activity_venue_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection