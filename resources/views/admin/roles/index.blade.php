@extends('layouts.admin')
@section('content')
@includeIf('admin.roles.create')
@includeIf('admin.roles.relationships.delete_modal')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
        </div>
        @can('role_create')
            <div>
                <button class="btn btn-success" data-toggle="modal" data-target="#create-roles">
                    {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                </button>
            </div>
        @endcan
    </div>


    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class="table table-bordered table-hover datatable datatable-Role">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>{{ trans('cruds.role.fields.id') }}</th>
                    <th>{{ trans('cruds.role.fields.title') }}</th>
                    <th>{{ trans('cruds.role.fields.permissions') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $key => $role)
                    <tr data-entry-id="{{ $role->id }}">
                        <td></td>
                        <td>{{ $role->id ?? '' }}</td>
                        <td>{{ $role->title ?? '' }}</td>
                        <td>
                            @foreach($role->permissions as $key => $item)
                                <span class="badge badge-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('role_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}"></a>
                            @endcan
                            @can('role_delete')
                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_modal_roles" data-id="{{ $role->id }}">
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('role_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.roles.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
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
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() })
                }
            }
        }
        //dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });
        let table = $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust(); 
        });
    })
</script>
@endsection

