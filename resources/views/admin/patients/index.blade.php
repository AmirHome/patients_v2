@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Patient">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.office') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.campaign_org') }}
                    </th>
                    <th>
                        {{ trans('cruds.campaignOrg.fields.started_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.surname') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.mother_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.father_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.citizenship') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.passport_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.passport_origin') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.foriegn_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.birthday') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.birth_place') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.height') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.blood_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.treating_doctor') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.passport_image') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($offices as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($campaign_orgs as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($provinces as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Patient::GENDER_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Patient::BLOOD_GROUP_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patients.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
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
    ajax: "{{ route('admin.patients.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'office_name', name: 'office.name' },
{ data: 'campaign_org_title', name: 'campaign_org.title' },
{ data: 'campaign_org.started_at', name: 'campaign_org.started_at' },
{ data: 'city_name', name: 'city.name' },
{ data: 'name', name: 'name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'surname', name: 'surname' },
{ data: 'mother_name', name: 'mother_name' },
{ data: 'father_name', name: 'father_name' },
{ data: 'citizenship', name: 'citizenship' },
{ data: 'passport_no', name: 'passport_no' },
{ data: 'passport_origin', name: 'passport_origin' },
{ data: 'phone', name: 'phone' },
{ data: 'foriegn_phone', name: 'foriegn_phone' },
{ data: 'email', name: 'email' },
{ data: 'gender', name: 'gender' },
{ data: 'birthday', name: 'birthday' },
{ data: 'birth_place', name: 'birth_place' },
{ data: 'address', name: 'address' },
{ data: 'weight', name: 'weight' },
{ data: 'height', name: 'height' },
{ data: 'blood_group', name: 'blood_group' },
{ data: 'treating_doctor', name: 'treating_doctor' },
{ data: 'code', name: 'code' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'passport_image', name: 'passport_image', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Patient').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection