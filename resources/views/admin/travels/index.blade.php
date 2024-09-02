@extends('layouts.admin')
@section('content')

@includeIf('admin.travels.relationships.delete_modal')

@includeIf('admin.travels.relationships.formFilter', [$genders])

<div class="card mt-4">
    <div class="card-header">
    <h4 class="form-title-text pt-2 pl-4 font-weight-bold">  {{ trans('cruds.travel.title_singular') }} {{ trans('global.list') }}</h4>

    </div>

    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
      <table class=" table table-bordered table-hover ajaxTable datatable datatable-Travel ">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                 
                    <th>
                      {{ trans('cruds.patient.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.patient') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.hospital') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.emergency') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.last_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.created_at') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: {
                url: "{{ route('admin.travels.index') }}",
                data: function(d) {
                    d.ff_patient_name = $('.filter[name="patient_name"]').val();
                    d.ff_patient_code = $('.filter[name="patient_code"]').val();
                    d.ff_gender = $('.filter[name="gender"]').val();

                    d.ff_phone = $('.filter[name="phone"]').val();
                    d.ff_status_id = $('.filter[name="status_id"]').val();
                    d.ff_department_id = $('.filter[name="department_id"]').val();
                    
                    d.ff_country_id = $('.filter[name="country_id"]').val();
                    d.ff_city_id = $('.filter[name="city_id"]').val();
                    d.ff_hospital_id = $('.filter[name="hospital_id"]').val();

                    d.ff_office_id = $('.filter[name="office_id"]').val();
                    d.ff_reffering_type = $('.filter[name="reffering_type"]').val();
                    d.ff_reffering = $('.filter[name="reffering"]').val();

                    d.ff_group_id = $('.filter[name="group_id"]').val();
                    d.ff_channel_id = $('.filter[name="channel_id"]').val();
                    d.ff_campaign_org_id = $('.filter[name="campaign_org_id"]').val();

                    d.ff_arrival_date_start = $('.filter[name="arrival_date_start"]').val();
                    d.ff_arrival_date_end = $('.filter[name="arrival_date_end"]').val();

                    d.ff_report_arrival_date_start = $('.filter[name="report_arrival_date_start"]').val();
                    d.ff_report_arrival_date_end = $('.filter[name="report_arrival_date_end"]').val();

                    d.ff_campaign_start = $('.filter[name="campaign_start"]').val();
                    d.ff_campaign_end = $('.filter[name="campaign_end"]').val();

                }
            },
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'patient.code', name: 'patient.code',
                    render: function(data, type, row) {
                        return '<a class="clickable-cell" href="{{ url('admin') }}/travels/'+row.id+'/edit">'+data+'</a>';
                    }
                },
                { data: 'patient_name', name: 'patient.name' },
                { data: 'patient_phone', name: 'patient.phone' },
                { data: 'hospital_name', name: 'hospital.name' },
                { data: 'group_name', name: 'group_name',visible: false },
                { data: 'department_name', name: 'department.name' },
                { data: 'last_status_title', name: 'last_status.title' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            createdRow: function (row, data, dataIndex) {
        if (data['group_name'] == 'Acil') {
            $(row).addClass('emergency');
          }
          },
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,

        };
        let table = $('.datatable-Travel').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        $('#form-filter-submit').click(function () {
            table.ajax.reload();
        });
    });
</script>
@endsection