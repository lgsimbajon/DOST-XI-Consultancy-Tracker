@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update a Recommendation for <b>| {{ $firm->beneficiary }} </b>
                    </div>
                    <div class="panel-body">

                        <form action="{{ route("admin.interventions.updateIntervention", [$interventions->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category">Consultancy Program</label>
                                <select name="category" id="category" class="form-control">
                                    @if($interventions->category == "MPEX")
                                        <option value="MPEX" selected>MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "CPT")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT" selected>CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "GMP Assessment")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment" selected>GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "GMP Seminar")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar" selected>GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "Plant Layout Design")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design" selected>Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "GMP Manual")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual" selected>GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "Energy Audit")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit" selected>Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "Packaging & Labeling")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling" selected>Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @elseif($interventions->category == "CAMPI")
                                        <option value="MPEX">MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual" selected>GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI" selected>CAMPI</option>
                                    @else
                                        <option value="MPEX" selected>MPEX</option>
                                        <option value="CPT">CPT</option>
                                        <option value="GMP Assessment">GMP Assessment</option>
                                        <option value="GMP Seminar">GMP Seminar</option>
                                        <option value="Plant Layout Design">Plant Layout Design</option>
                                        <option value="GMP Manual">GMP Manual</option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Packaging & Labeling">Packaging & Labeling</option>
                                        <option value="CAMPI">CAMPI</option>
                                    @endif

                                </select>

                                <input type="hidden" id="new_firms_id" name="new_firms_id" value="{{$firmId}}">
                                {{--<input type="hidden" id="id" name="id" value="{{$id}}">--}}
                            </div>
                            <div class="form-group">
                                <label for="areas_for_improvement">Areas for Improvement</label>
                                <textarea id="areas_for_improvement" name="areas_for_improvement" class="form-control" >{{$interventions->areas_for_improvement}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="recommendations_short_term">Short-term Recommendations</label>
                                <textarea id="recommendations_short_term" name="recommendations_short_term" class="form-control">{{$interventions->recommendations_short_term}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="recommendations_long_term">Long-term Recommendations</label>
                                <textarea id="recommendations_long_term" name="recommendations_long_term" class="form-control">{{$interventions->recommendations_long_term}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="p">Prioritization</label><b>

                                    <select name="p" id="p" class="form-control">
                                        @if($interventions->p == "1")
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="NA">NA</option>
                                        @elseif($interventions->p == "2")
                                            <option value="1">1</option>
                                            <option value="2" selected>2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="NA">NA</option>
                                        @elseif($interventions->p == "3")
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3" selected>3</option>
                                            <option value="4">4</option>
                                            <option value="NA">NA</option>
                                        @elseif($interventions->p == "4")
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4" selected>4</option>
                                            <option value="NA">NA</option>
                                        @else
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="NA" selected>NA</option>
                                        @endif

                                    </select></b>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea id="remarks" name="remarks" class="form-control" >{{$interventions->remarks}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label><br>
                                @if($interventions->status == "Implemented")
                                    <input type="radio" value="Implemented" checked name="status" id="status" required>
                                    <span id="imptxt">Implemented </span>
                                    &emsp;&emsp;&emsp;
                                    <input type="radio" value="Not Implemented" name="status" id="status" required>
                                    <span id="nimptxt"> Not Implemented</span>
                                @else
                                    <input type="radio" value="Implemented" name="status" id="status" required>
                                    <span id="imptxt">Implemented </span>
                                    &emsp;&emsp;&emsp;
                                    <input type="radio" value="Not Implemented" checked name="status" id="status" required>
                                    <span id="nimptxt"> Not Implemented</span>
                                @endif


                            </div>
                            <div class="form-group">
                                <label for="results">Results</label>
                                <textarea id="results" name="results" class="form-control" >{{$interventions->results}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="cost_of_implementations">Cost of Implementation</label>
                                <input type="number" id="cost_of_implementations" name="cost_of_implementations" class="form-control" value="{{$interventions->cost_of_implementations}}">
                            </div>
                            <div class="form-group">
                                <label for="comments_problems">Comments / Problems</label>
                                <textarea id="comments_problems" name="comments_problems" class="form-control">{{$interventions->comments_problems}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="plan_of_action">Plan of Action</label>
                                <textarea id="plan_of_action" name="plan_of_action" class="form-control" >{{$interventions->plan_of_action}}</textarea>
                            </div>

                            <div style="background-color: #cccccc; padding: 10px;">
                                <p>(P) Legend:</p>
                                <p style="margin-left: 10px;">
                                    <b>1</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;within 3 months&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>N/A</b> &nbsp;&nbsp;not applicable
                                    <br>
                                    <b>2</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;within 6 months
                                    <br>
                                    <b>3</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6 months to 1 year (within a year)
                                    <br>
                                    <b>4</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;over a year
                                    <br>

                                </p>
                            </div>
                            <br>


                            <div>
                                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                            </div>

                            <a style="margin-top:20px;" class="btn btn-default" href="{{ route("admin.interventions.list", $firmId) }}">
                                {{ trans('global.back_to_list') }}
                            </a>

                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection