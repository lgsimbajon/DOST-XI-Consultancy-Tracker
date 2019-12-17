<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInterventionsRequest;
use App\Interventions;
use App\NewFirm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InterventionsController extends Controller
{

    public function index()
    {
        //
    }


    public function list(Request $request, $fileId)
    {
        if ($request->ajax()) {
            $query = Interventions::query()->select(sprintf('%s.*', (new Interventions)->table))->where('new_firms_id', '=', $fileId);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'new_firm_show';
                $editGate      = 'new_firm_edit';
                $deleteGate    = 'new_firm_delete';
                $crudRoutePart = 'interventions';

                return view('partials.datatablesActionsForInterventions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : "";
            });
            $table->editColumn('areas_for_improvement', function ($row) {
                return $row->areas_for_improvement ? $row->areas_for_improvement : "";
            });
            $table->editColumn('recommendations_short_term', function ($row) {
                return $row->recommendations_short_term ? $row->recommendations_short_term : "";
            });
            $table->editColumn('recommendations_long_term', function ($row) {
                return $row->recommendations_long_term ? $row->recommendations_long_term : "";
            });
            $table->editColumn('p', function ($row) {
                return $row->p ? $row->p : "";
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : "";
            });
            $table->editColumn('status', function ($row) {
                if ($row->status == 'Implemented')
                {
                    return  $row->status ? '<b style="color: green;">'.$row->status.'</b>' : "";
                }
                else
                {
                    return  $row->status ? '<b style="color: red;">'.$row->status.'</b>' : "";
                }

            });
            $table->editColumn('results', function ($row) {
                return $row->results ? $row->results : "";
            });


            $table->editColumn('cost_of_implementations', function ($row) {
                return $row->cost_of_implementations ? $row->cost_of_implementations : "";
            });
            $table->editColumn('comments_problems', function ($row) {
                return $row->comments_problems ? $row->comments_problems : "";
            });
            $table->editColumn('plan_of_action', function ($row) {
                return $row->plan_of_action ? $row->plan_of_action : "";
            });


            $table->rawColumns(['actions', 'placeholder','status']);

            return $table->make(true);
        }

        $firm = NewFirm::find($fileId);

        return view('admin.interventions.index', compact('fileId', 'firm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function newintervention($id)
    {
        $firm = NewFirm::find($id);

        return view('admin.interventions.create', compact('id', 'firm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Interventions::create($request->all());

        $input = $request->all();

        $id = $input['new_firms_id'];

        return redirect()->route('admin.interventions.list', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interventions = Interventions::find($id);

        $firmId = $interventions->new_firms_id;

        $firm = NewFirm::find($firmId);

        return view('admin.interventions.show', compact('interventions', 'firm', 'firmId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interventions = Interventions::find($id);

        $firmId = $interventions->new_firms_id;

        $firm = NewFirm::find($firmId);

        return view('admin.interventions.edit', compact('interventions', 'firm', 'firmId', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interventions $interventions)
    {
        //Override by updateIntervention
    }

    public function updateIntervention(Request $request, $id)
    {
        $interventions = Interventions::findOrFail($id);

        $interventions->update($request->all());

        $input = $request->all();

        $firmId = $input['new_firms_id'];

        return redirect()->route('admin.interventions.list', $firmId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interventions = Interventions::findOrFail($id);
        $interventions->delete();

        return back();
    }

    public function massDestroy(MassDestroyInterventionsRequest $request)
    {
        Interventions::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
