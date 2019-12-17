<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserAlertRequest;
use App\Http\Requests\StoreUserAlertRequest;
use App\User;
use App\UserAlert;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class UserAlertsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlerts = UserAlert::all();

        return view('admin.userAlerts.index', compact('userAlerts'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_alert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        return view('admin.userAlerts.create', compact('users'));
    }

    public function store(StoreUserAlertRequest $request)
    {
        $input = $request->all();

        $maxId = UserAlert::withTrashed()->max('id');

        $maxId+=1;

        $input['alert_link'] = URL::to('/admin/user-alerts/').'/'.$maxId;

        $userAlert = UserAlert::create($input);
        $userAlert->users()->sync($request->input('users', []));

        return redirect()->route('admin.user-alerts.index');
    }

    public function show(UserAlert $userAlert)
    {
//        abort_if(Gate::denies('user_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlert->load('users');

        $alertId = $userAlert->id;

        $this->read($alertId);

        return view('admin.userAlerts.show', compact('userAlert'));
    }

    public function destroy(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlert->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAlertRequest $request)
    {
        UserAlert::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function read($alertId)
    {
        $alerts = \Auth::user()->userAlerts()->where('read', false)->where('user_alert_id', $alertId)->get();

        foreach ($alerts as $alert) {
            $pivot       = $alert->pivot;
            $pivot->read = true;
            $pivot->save();
        }
    }
}
