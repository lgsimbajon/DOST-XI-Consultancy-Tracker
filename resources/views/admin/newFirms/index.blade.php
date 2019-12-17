@extends('layouts.admin')
@section('content')
<div class="content">
    @can('new_firm_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.new-firms.create") }}">
                    Add New Firm
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Consultancy Services Provided by DOST XI to SETUP Cooperators</h4>
                </div>
                <div class="panel-body">

                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NewFirm">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.newFirm.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.newFirm.fields.province') }}
                                </th>
                                <th>
                                    {{ trans('cruds.newFirm.fields.beneficiary') }}
                                </th>
                                <th>
                                    {{ trans('cruds.newFirm.fields.cy_approvedsu') }}
                                </th>
                                <th>
                                    MPEX
                                </th>
                                <th>
                                    CPT
                                </th>
                                <th>
                                    GMP Assessment
                                </th>
                                <th>
                                    GMP Seminar
                                </th>
                                <th>
                                    Plant Layout Design
                                </th>
                                <th>
                                    GMP Manual
                                </th>
                                <th>
                                    Energy Audit
                                </th>
                                <th>
                                    Packaging & Labeling
                                </th>
                                <th>
                                    CAMPI
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>


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
    url: "{{ route('admin.new-firms.massDestroy') }}",
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
    ajax: "{{ route('admin.new-firms.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'province', name: 'province' },
{ data: 'beneficiary', name: 'beneficiary' },
{ data: 'cy_approvedsu', name: 'cy_approvedsu' },
{ data: 'mpex', name: 'mpex' },
{ data: 'cpt', name: 'cpt' },
{ data: 'gmp_assessment', name: 'gmp_assessment' },
{ data: 'gmp_seminar', name: 'gmp_seminar' },
{ data: 'plant_layout_design', name: 'plant_layout_design' },
{ data: 'gmp_manual', name: 'gmp_manual' },
{ data: 'energy_audit', name: 'energy_audit' },
{ data: 'packaging_labeling', name: 'packaging_labeling' },
{ data: 'campi', name: 'campi' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-NewFirm').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection