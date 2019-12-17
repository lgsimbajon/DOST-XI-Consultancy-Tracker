@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload New File
                    </div>
                    <div class="panel-body">

                        <form action="{{ route("admin.uploads.savefile", $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" id="file" required>
                                <input type="hidden" name="new_firms_id" value="{{$id}}">
                            </div>
                            <div>
                                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                            </div>
                        </form>

                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection