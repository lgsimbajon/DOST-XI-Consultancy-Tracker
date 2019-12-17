@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="panel panel-default">
            <div class="row">
                <div class="col-lg-12" style="font-size: x-large; font-weight: bold; text-align: center; padding: 20px; padding-bottom: 40px">
                    Welcome to DOST XI - Consultancy Tracker
                </div>
            </div>
            <div class="row" style="padding: 10px;">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3>{{$services}}</h3>

                            <p>Provided Consultancy Services</p>
                        </div>
                        <div class="icon">
                            <i class="fa-fw fas fa-bar-chart" style=""></i>
                        </div>
                        <a href="{{ route("admin.new-firms.index") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$implemented}}</h3>

                            <p>Implemented Recommendation(s)</p>
                        </div>
                        <div class="icon">
                            <i class="fa-fw fas fa-calendar-check"></i>
                        </div>
                        <a href="{{ route("admin.new-firms.index") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{$unimplemented}}</h3>

                            <p>Unimplemented Recommendation(s)</p>
                        </div>
                        <div class="icon">
                            <i class="fa-fw fas fa-calendar-times"></i>
                        </div>
                        <a href="{{ route("admin.new-firms.index") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    @php($unread = \App\QaTopic::unreadCount())
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>
                                @if($unread > 0)
                                    ( {{ $unread }} )
                                @else
                                    0
                                @endif
                            </h3>

                            <p>New Message(s)</p>
                        </div>
                        <div class="icon">
                            <i class="fa-fw fas fa-comment"></i>
                        </div>
                        <a href="{{ route("admin.messenger.index") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <img class="img" style="max-width: 100%" src="{{ URL::to('/') }}/img/SETUP.png">
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
@endsection