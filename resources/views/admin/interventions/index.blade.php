@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('new_firm_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route("admin.interventions.newintervention", $fileId) }}">
                        Add New Recommendation
                    </a>

                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b style="text-transform: uppercase;">{{ $firm->beneficiary }} | </b> List of Recommendations
                    </div>
                    <div class="panel-body">

                        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Interventions">
                            <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Consultancy Program
                                </th>
                                <th>
                                    Areas for Improvement
                                </th>
                                <th>
                                    Short-term Recommendations
                                </th>
                                <th>
                                    Long-term Recommendations
                                </th>
                                <th>
                                    Prioritization
                                </th>
                                <th>
                                    Remarks
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Results
                                </th>
                                <th>
                                    Cost of Implementation
                                </th>
                                <th>
                                    Comments / Problems
                                </th>
                                <th>
                                    Plan of Action
                                </th>

                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ route("admin.new-firms.index") }}">
                            {{ trans('global.back_to_list') }}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @can('new_firm_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.interventions.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('Are you sure you want to delete these records? This action CANNOT be undone.')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }})
                        .done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
                @endcan

        let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.interventions.list', $fileId) }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'category', name: 'category' },
                    { data: 'areas_for_improvement', name: 'areas_for_improvement' },
                    { data: 'recommendations_short_term', name: 'recommendations_short_term' },
                    { data: 'recommendations_long_term', name: 'recommendations_long_term' },
                    { data: 'p', name: 'p' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'status', name: 'status' },
                    { data: 'results', name: 'results' },

                    { data: 'cost_of_implementations', name: 'cost_of_implementations' },
                    { data: 'comments_problems', name: 'comments_problems' },
                    { data: 'plan_of_action', name: 'plan_of_action' },

                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
        $('.datatable-Interventions').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });

</script>
@endsection