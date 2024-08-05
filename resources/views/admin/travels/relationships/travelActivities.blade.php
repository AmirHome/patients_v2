<div class="table-responsive">
    <table class=" table table-bordered table-striped table-hover datatable datatable-travelActivities">
        <thead class="d-none">
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.activity.fields.id') }}

                    {{ trans('cruds.activity.fields.user') }}

                    {{ trans('cruds.user.fields.email') }}

                    {{ trans('cruds.activity.fields.travel') }}

                    {{ trans('cruds.travel.fields.reffering') }}

                    {{ trans('cruds.activity.fields.description') }}

                    {{ trans('cruds.activity.fields.status') }}

                    {{ trans('cruds.activity.fields.document_file') }}

                    {{ trans('cruds.activity.fields.document_name') }}
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
        </thead>
        <tbody >
            @foreach ($activities as $key => $activity)
            <tr data-entry-id="{{ $activity->id }}" class="activity-hover">
                <td colspan="3" class="activity-hover">
                    <div class="container-fluid custom-border activity-card">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-between">
                                <div>
                                    <div class="activity-title">
                                        <i class="fas fa-chevron-down mx-3 mb-3 pointer"  style="color:#006C9C"></i>
                                         <i class="fas fa-chevron-right test mx-3 mb-3 pointer"  style="color:#006C9C;"></i> 
                                         {{ $activity->status->title ?? '' }}</div>
                                    <div class="activity-info mx-3 pt-2">{{ $activity->user->name ?? '' }}</div>
                                    <div class="mx-3">
                                        @if (!empty($activity->description))
                                        <div class="activity-desc mt-2">
                                            {{ $activity->description ?? '' }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="activity-info"><span>{{ $activity->created_at ?? '' }}</span></div>
                                    @can('travel_treatment_activity_edit')
                                    <button class="btn btn-outline-success mt-5 " href="{{ route('admin.activities.edit', $activity->id) }}">
                                        <i class="fa fa-pencil"></i> Düzenle
                                    </button>
                                    @endcan
                                    @can('travel_treatment_activity_delete')
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <table class="table table-custom">
                            <thead>
                                <tr class="activity-th">
                                    <th>{{ trans('cruds.travel.fields.file') }}</th>
                                    <th>{{ trans('cruds.travel.fields.uploaded_by') }}</th>
                                    <th>{{ trans('cruds.travel.fields.explanation') }}</th>
                                    <th>{{ trans('cruds.travel.fields.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="activity-td">
                                    <td>socio-respectively-366996.pptx</td>
                                    <td>Serra Tacar - Merkez Ofis</td>
                                    <td>test deneme2344</td>
                                    <td>12/03/2024 08:56:00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@section('scripts')
    @parent
    <script>
        $(function() {
            //   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-travelActivities:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
