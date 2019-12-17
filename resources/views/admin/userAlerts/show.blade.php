@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.userAlert.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.alert_text') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->alert_text }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.start_time') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->start_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.end_time') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->end_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Staff Involved
                                    </th>
                                    <td>
                                        @foreach($userAlert->users as $id => $user)
                                            <span class="label label-info label-many">{{ $user->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userAlert.fields.activity_venue') }}
                                    </th>
                                    <td>
                                        {{ $userAlert->activity_venue }}
                                    </td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<th>--}}
                                        {{--{{ trans('cruds.userAlert.fields.created_at') }}--}}
                                    {{--</th>--}}
                                    {{--<td>--}}
                                        {{--{{ $userAlert->created_at }}--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection