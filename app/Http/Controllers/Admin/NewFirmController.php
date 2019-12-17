<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewFirmRequest;
use App\Http\Requests\StoreNewFirmRequest;
use App\Http\Requests\UpdateNewFirmRequest;
use App\NewFirm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NewFirmController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = NewFirm::query()->select(sprintf('%s.*', (new NewFirm)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'new_firm_show';
                $editGate      = 'new_firm_edit';
                $uploadGate    = 'new_firm_upload';
                $deleteGate    = 'new_firm_delete';
                $crudRoutePart = 'new-firms';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'uploadGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('province', function ($row) {
                return $row->province ? NewFirm::PROVINCE_SELECT[$row->province] : '';
            });
            $table->editColumn('beneficiary', function ($row) {
                return $row->beneficiary ? $row->beneficiary : "";
            });
            $table->editColumn('cy_approvedsu', function ($row) {
                return $row->cy_approvedsu ? $row->cy_approvedsu : "";
            });


            $table->editColumn('mpex', function ($row) {
                return $row->mpex ? $row->mpex : "";
            });
            $table->editColumn('cpt', function ($row) {
                return $row->cpt ? $row->cpt : "";
            });
            $table->editColumn('gmp_assessment', function ($row) {
                return $row->gmp_assessment ? $row->gmp_assessment : "";
            });
            $table->editColumn('gmp_seminar', function ($row) {
                return $row->gmp_seminar ? $row->gmp_seminar : "";
            });
            $table->editColumn('plant_layout_design', function ($row) {
                return $row->plant_layout_design ? $row->plant_layout_design : "";
            });
            $table->editColumn('gmp_manual', function ($row) {
                return $row->gmp_manual ? $row->gmp_manual : "";
            });
            $table->editColumn('energy_audit', function ($row) {
                return $row->energy_audit ? $row->energy_audit : "";
            });
            $table->editColumn('packaging_labeling', function ($row) {
                return $row->packaging_labeling ? $row->packaging_labeling : "";
            });
            $table->editColumn('campi', function ($row) {
                return $row->campi ? $row->campi : "";
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.newFirms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('new_firm_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newFirms.create');
    }

    public function store(StoreNewFirmRequest $request)
    {
        $newFirm = NewFirm::create($request->all());

        return redirect()->route('admin.new-firms.index');
    }

    public function edit(NewFirm $newFirm)
    {
        abort_if(Gate::denies('new_firm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newFirms.edit', compact('newFirm'));
    }

    public function update(UpdateNewFirmRequest $request, NewFirm $newFirm)
    {
        $newFirm->update($request->all());

        return redirect()->route('admin.new-firms.index');
    }

    public function upload()
    {
        return view('admin.newFirms.upload');
    }

    public function show(NewFirm $newFirm)
    {
        abort_if(Gate::denies('new_firm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newFirms.show', compact('newFirm'));
    }

    public function destroy(NewFirm $newFirm)
    {
        abort_if(Gate::denies('new_firm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newFirm->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewFirmRequest $request)
    {
        NewFirm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
