@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4>Report on the Number of Conducted Consultancy Services Annually
                            <small>Provided by DOST XI to SETUP Cooperators</small>
                        </h4>

                    </div>
                    <div class="panel-body">

                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-12" style="padding-left: 30px; padding-right: 30px;">
                                <div class="form-group">
                                    <center>
                                        <label style="font-size: 22px;" for="to">Conducted Consultancy Services in {{$province}} for the Year {{$oFrom}}-{{$to}}</label>
                                    </center>

                                </div>


                                        {!! html_entity_decode($output) !!}



                            </div>
                        </div>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ route("admin.reports.index") }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection