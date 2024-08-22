<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover off-datatable-travelTravelTreatmentActivities">
        <tbody>
            @foreach ($travelTreatmentActivities as $key => $travelTreatmentActivity)
                <tr data-entry-id="{{ $travelTreatmentActivity->id }}" class="activity-hover">
                    <td colspan="3" class="activity-hover">
                        <div class="container-fluid custom-border activity-card">
                            <div class="row mb-3">
                                <div class="col-12 d-flex justify-content-between">
                                    <div>
                                        <div class="activity-title">
                                            <i class="fas fa-chevron-down mx-3 mb-3 pointer" style="color:#006C9C"></i>
                                            <i class="fas fa-chevron-right test mx-3 mb-3 pointer" style="color:#006C9C;"></i>
                                            {{ $travelTreatmentActivity->status->title ?? '' }}
                                        </div>

                                        <div class="mx-3">
                                            @if (!empty($travelTreatmentActivity->description))
                                                <div class="activity-desc mt-2">
                                                    {{ $travelTreatmentActivity->description }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="activity-info"><span>{{ $travelTreatmentActivity->created_at ?? '' }}</span></div>
                                        @can('travel_treatment_activity_edit')
                                            <button type="button" class="btn btn-outline-success mt-5 " data-toggle="modal" data-target="#modal-edit-travel-treatment-activities" data-travel-treatment-activities_id={{ $travelTreatmentActivity->id }}>
                                                <i class="fa fa-pencil"></i> {{ trans('cruds.travel.fields.edit') }}
                                            </button>
                                        @endcan
                                        @can('travel_treatment_activity_delete')
                                            <form action="{{ route('admin.travel-treatment-activities.destroy', $travelTreatmentActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">

                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <table class="table table-custom {{($travelTreatmentActivity->treatment_file->count()>0) ? '' : 'd-none'}}">
                                <thead>
                                    <tr class="activity-th row mx-3">
                                        <th  class="col-md-5">{{ trans('cruds.travel.fields.file') }}</th>
                                        <th  class="col-md-4">{{ trans('cruds.travel.fields.uploaded_by') }}</th>
                                        <th  class="col-md-3">{{ trans('cruds.travel.fields.date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($travelTreatmentActivity->treatment_file as $key => $media)
                                        <tr class="activity-td row mx-3">
                                            <td  class="col-md-5">
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: 500;">
                                                    {{ Str::limit($media->file_name, 50, '...') }}
                                                </a>
                                            </td>
                                            <td  class="col-md-4">{{ $travelTreatmentActivity->user->name ?? '' }} - {{ $travelTreatmentActivity->user->office->name ?? '' }}</td>
                                            <td  class="col-md-3">{{ $travelTreatmentActivity->created_at ?? '' }}</td>
                                        </tr>
                                    @endforeach
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
        document.addEventListener('DOMContentLoaded', (event) => {
            const downIcons = document.querySelectorAll('.fa-chevron-down');
            const rightIcons = document.querySelectorAll('.test');
            const tables = document.querySelectorAll('.table-custom');

            downIcons.forEach((icon, index) => {
                const table = tables[index];
                const rightIcon = rightIcons[index];
                // Initial state setup
                table.style.display = 'table';
                icon.style.display = 'inline';
                rightIcon.style.display = 'none';

                icon.addEventListener('click', () => {
                    table.style.display = 'none';
                    icon.style.display = 'none';
                    rightIcon.style.display = 'inline';
                });

                rightIcon.addEventListener('click', () => {
                    table.style.display = 'table';
                    rightIcon.style.display = 'none';
                    icon.style.display = 'inline';
                });
            });
        });
    </script>
@endsection
