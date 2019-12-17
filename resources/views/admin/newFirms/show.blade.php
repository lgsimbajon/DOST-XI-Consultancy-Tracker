@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    View Details
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
                                        {{ $newFirm->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.province') }}
                                    </th>
                                    <td>
                                        {{ App\NewFirm::PROVINCE_SELECT[$newFirm->province] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.beneficiary') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->beneficiary }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.cy_approvedsu') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->cy_approvedsu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.mpex') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->mpex }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.cpt') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->cpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.gmp_assessment') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->gmp_assessment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.gmp_seminar') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->gmp_seminar }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.plant_layout_design') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->plant_layout_design }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.gmp_manual') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->gmp_manual }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.energy_audit') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->energy_audit }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.packaging_labeling') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->packaging_labeling }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newFirm.fields.campi') }}
                                    </th>
                                    <td>
                                        {{ $newFirm->campi }}
                                    </td>
                                </tr>
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