<?php
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Uploads;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // New Firms *now Materlist
    Route::delete('new-firms/destroy', 'NewFirmController@massDestroy')->name('new-firms.massDestroy');
    Route::resource('new-firms', 'NewFirmController');

    // Uploads
    Route::delete('uploads/destroy', 'UploadsController@massDestroy')->name('uploads.massDestroy');
    Route::get('files/{id}', 'UploadsController@files')->name('uploads.files');
    Route::get('newfile/{id}', 'UploadsController@newfile')->name('uploads.newfile');
    Route::post('savefile/{id}', 'UploadsController@savefile')->name('uploads.savefile');
    Route::resource('uploads', 'UploadsController');

    //Interventions
    Route::delete('interventions/destroy', 'InterventionsController@massDestroy')->name('interventions.massDestroy');
    Route::get('list/{id}', 'InterventionsController@list')->name('interventions.list');
    Route::get('newintervention/{id}', 'InterventionsController@newintervention')->name('interventions.newintervention');
    Route::post('updateIntervention/{id}', 'InterventionsController@updateIntervention')->name('interventions.updateIntervention');
    Route::resource('interventions', 'InterventionsController');

    // Reports
    Route::post('view', 'ReportsController@view')->name('reports.view');
    Route::resource('reports', 'ReportsController', ['except' => ['create', 'show', 'store', 'edit', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});

