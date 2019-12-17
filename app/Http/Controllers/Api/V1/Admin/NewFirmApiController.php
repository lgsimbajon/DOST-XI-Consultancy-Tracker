<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewFirmRequest;
use App\Http\Requests\UpdateNewFirmRequest;
use App\Http\Resources\Admin\NewFirmResource;
use App\NewFirm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewFirmApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('new_firm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NewFirmResource(NewFirm::all());
    }

    public function store(StoreNewFirmRequest $request)
    {
        $newFirm = NewFirm::create($request->all());

        return (new NewFirmResource($newFirm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NewFirm $newFirm)
    {
        abort_if(Gate::denies('new_firm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NewFirmResource($newFirm);
    }

    public function update(UpdateNewFirmRequest $request, NewFirm $newFirm)
    {
        $newFirm->update($request->all());

        return (new NewFirmResource($newFirm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    public function destroy(NewFirm $newFirm)
    {
        abort_if(Gate::denies('new_firm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newFirm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
