@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>{{ $firm->beneficiary }}</b> Recommendation Details
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $interventions->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Category
                                    </th>
                                    <td>
                                        {{ $interventions->category }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Areas for Improvement
                                    </th>
                                    <td>
                                        {{ $interventions->areas_for_improvement }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Short-term Recommendations
                                    </th>
                                    <td>
                                        {{ $interventions->recommendations_short_term }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Long-term Recommendations
                                    </th>
                                    <td>
                                        {{ $interventions->recommendations_long_term }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Prioritization
                                    </th>
                                    <td>
                                        {{ $interventions->p }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Remarks
                                    </th>
                                    <td>
                                        {{ $interventions->remarks }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        @if($interventions->status == "Implemented")
                                            <b style="color: green">
                                                {{  $interventions->status }}
                                            </b>
                                        @else
                                            <b style="color: red">
                                                {{  $interventions->status }}
                                            </b>

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Results
                                    </th>
                                    <td>
                                        {{ $interventions->results }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Cost of Implementation
                                    </th>
                                    <td>
                                        {{ '₱'.number_format($interventions->cost_of_implementations, 2)  }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Comments / Problems
                                    </th>
                                    <td>
                                        {{ $interventions->comments_problems }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Plan of Action
                                    </th>
                                    <td>
                                        {{ $interventions->plan_of_action }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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


                            <a style="margin-top:20px;" class="btn btn-default" href="{{ route("admin.interventions.list", $firmId) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection