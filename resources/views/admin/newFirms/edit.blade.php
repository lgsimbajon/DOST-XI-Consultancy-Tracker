@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.newFirm.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.new-firms.update", [$newFirm->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
                            <label for="province">{{ trans('cruds.newFirm.fields.province') }}*</label>
                            <select id="province" name="province" class="form-control" required>
                                <option value="" disabled {{ old('province', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\NewFirm::PROVINCE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('province', $newFirm->province) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('province'))
                                <p class="help-block">
                                    {{ $errors->first('province') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('beneficiary') ? 'has-error' : '' }}">
                            <label for="beneficiary">{{ trans('cruds.newFirm.fields.beneficiary') }}*</label>
                            <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="{{ old('beneficiary', isset($newFirm) ? $newFirm->beneficiary : '') }}" required>
                            @if($errors->has('beneficiary'))
                                <p class="help-block">
                                    {{ $errors->first('beneficiary') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.beneficiary_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('cy_approvedsu') ? 'has-error' : '' }}">
                            <label for="cy_approvedsu">{{ trans('cruds.newFirm.fields.cy_approvedsu') }}*</label>
                            <input type="number" id="cy_approvedsu" name="cy_approvedsu" class="form-control" value="{{ old('cy_approvedsu', isset($newFirm) ? $newFirm->cy_approvedsu : '') }}" step="1" required>
                            @if($errors->has('cy_approvedsu'))
                                <p class="help-block">
                                    {{ $errors->first('cy_approvedsu') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.cy_approvedsu_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('mpex') ? 'has-error' : '' }}">
                            <label for="mpex">{{ trans('cruds.newFirm.fields.mpex') }}</label>
                            <input type="text" id="mpex" name="mpex" class="form-control" value="{{ old('mpex', isset($newFirm) ? $newFirm->mpex : '') }}">
                            @if($errors->has('mpex'))
                                <p class="help-block">
                                    {{ $errors->first('mpex') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.mpex_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('cpt') ? 'has-error' : '' }}">
                            <label for="cpt">{{ trans('cruds.newFirm.fields.cpt') }}</label>
                            <input type="text" id="cpt" name="cpt" class="form-control" value="{{ old('cpt', isset($newFirm) ? $newFirm->cpt : '') }}">
                            @if($errors->has('cpt'))
                                <p class="help-block">
                                    {{ $errors->first('cpt') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.cpt_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('gmp_assessment') ? 'has-error' : '' }}">
                            <label for="gmp_assessment">{{ trans('cruds.newFirm.fields.gmp_assessment') }}</label>
                            <input type="text" id="gmp_assessment" name="gmp_assessment" class="form-control" value="{{ old('gmp_assessment', isset($newFirm) ? $newFirm->gmp_assessment : '') }}">
                            @if($errors->has('gmp_assessment'))
                                <p class="help-block">
                                    {{ $errors->first('gmp_assessment') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.gmp_assessment_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('gmp_seminar') ? 'has-error' : '' }}">
                            <label for="gmp_seminar">{{ trans('cruds.newFirm.fields.gmp_seminar') }}</label>
                            <input type="text" id="gmp_seminar" name="gmp_seminar" class="form-control" value="{{ old('gmp_seminar', isset($newFirm) ? $newFirm->gmp_seminar : '') }}">
                            @if($errors->has('gmp_seminar'))
                                <p class="help-block">
                                    {{ $errors->first('gmp_seminar') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.gmp_seminar_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('plant_layout_design') ? 'has-error' : '' }}">
                            <label for="plant_layout_design">{{ trans('cruds.newFirm.fields.plant_layout_design') }}</label>
                            <input type="text" id="plant_layout_design" name="plant_layout_design" class="form-control" value="{{ old('plant_layout_design', isset($newFirm) ? $newFirm->plant_layout_design : '') }}">
                            @if($errors->has('plant_layout_design'))
                                <p class="help-block">
                                    {{ $errors->first('plant_layout_design') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.plant_layout_design_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('gmp_manual') ? 'has-error' : '' }}">
                            <label for="gmp_manual">{{ trans('cruds.newFirm.fields.gmp_manual') }}</label>
                            <input type="text" id="gmp_manual" name="gmp_manual" class="form-control" value="{{ old('gmp_manual', isset($newFirm) ? $newFirm->gmp_manual : '') }}">
                            @if($errors->has('gmp_manual'))
                                <p class="help-block">
                                    {{ $errors->first('gmp_manual') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.gmp_manual_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('energy_audit') ? 'has-error' : '' }}">
                            <label for="energy_audit">{{ trans('cruds.newFirm.fields.energy_audit') }}</label>
                            <input type="text" id="energy_audit" name="energy_audit" class="form-control" value="{{ old('energy_audit', isset($newFirm) ? $newFirm->energy_audit : '') }}">
                            @if($errors->has('energy_audit'))
                                <p class="help-block">
                                    {{ $errors->first('energy_audit') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.energy_audit_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('packaging_labeling') ? 'has-error' : '' }}">
                            <label for="packaging_labeling">{{ trans('cruds.newFirm.fields.packaging_labeling') }}</label>
                            <input type="text" id="packaging_labeling" name="packaging_labeling" class="form-control" value="{{ old('packaging_labeling', isset($newFirm) ? $newFirm->packaging_labeling : '') }}">
                            @if($errors->has('packaging_labeling'))
                                <p class="help-block">
                                    {{ $errors->first('packaging_labeling') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.packaging_labeling_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('campi') ? 'has-error' : '' }}">
                            <label for="campi">{{ trans('cruds.newFirm.fields.campi') }}</label>
                            <input type="text" id="campi" name="campi" class="form-control" value="{{ old('campi', isset($newFirm) ? $newFirm->campi : '') }}">
                            @if($errors->has('campi'))
                                <p class="help-block">
                                    {{ $errors->first('campi') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.newFirm.fields.campi_helper') }}
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