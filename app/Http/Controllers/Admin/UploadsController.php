<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUploadsRequest;
use App\Uploads;
use App\NewFirm;
use Illuminate\Support\Facades\Storage;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public $fileId;
//
//    public function __construct()
//    {
//        $this->fileId = "1";
//    }

    public function files(Request $request, $fileId)
    {
//        $request = new Request();
        if ($request->ajax()) {
            $query = Uploads::query()->select(sprintf('%s.*', (new Uploads)->table))->where('new_firms_id', '=', $fileId);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'new_firm_show';
                $deleteGate = 'new_firm_delete';
                $crudRoutePart2 = 'uploads';

                return view('partials.datatablesActionsForUploads', compact(
                    'viewGate',
                    'deleteGate',
                    'crudRoutePart2',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('file_name', function ($row) {
                return $row->file_name ? $row->file_name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $firm = NewFirm::find($fileId);

        return view('admin.uploads.index', compact('fileId', 'firm'));
    }

    public function index(Request $request)
    {
        //Override by admin.files route
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.uploads.create', compact('id'));
    }

    public function newfile($id)
    {
        return view('admin.uploads.create', compact('id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    public function savefile(Request $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('file'))
        {
            $path = 'files/firm'.$id;


            if (!Storage::disk('public')->exists($path))
            {
                Storage::disk('public')->makeDirectory($path);
            }

            $name = $file->getClientOriginalName();
            $file->move($path, $name);
            $input['path'] = $path.'/'.$name;
            $input['file_name'] = $name;
        }

        Uploads::create($input);

        return redirect()->route('admin.uploads.files', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $uploads = Uploads::findOrFail($id);
        $uploads->delete();

        return back();
    }

    public function massDestroy(MassDestroyUploadsRequest $request)
    {
        Uploads::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
