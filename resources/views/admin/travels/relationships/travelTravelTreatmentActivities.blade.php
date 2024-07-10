<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover datatable datatable-travelTravelTreatmentActivities">
        <thead class="d-none">
            <tr>
                <th width="10"></th>
                <th>
                    {{ trans('cruds.travelTreatmentActivity.fields.travel') }}
                    {{ trans('cruds.travel.fields.reffering') }}
                    {{ trans('cruds.travelTreatmentActivity.fields.status') }}
                    {{ trans('cruds.travelTreatmentActivity.fields.description') }}
                    {{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}
                </th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody >
            @foreach ($travelTreatmentActivities as $key => $travelTreatmentActivity)
            <tr data-entry-id="{{ $travelTreatmentActivity->id }}" class="activity-hover">
                <td colspan="3" class="activity-hover">
                    <div class="container-fluid custom-border activity-card">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-between">
                                <div>
                                    <div class="activity-title">
                                        <i class="fas fa-chevron-down mx-3 mb-3 pointer"  style="color:#00B8D9"></i>
                                         <i class="fas fa-chevron-right test mx-3 mb-3 pointer"  style="color:#00B8D9;"></i> 
                                        {{ $travelTreatmentActivity->status->title ?? '' }}</div>
                                    <div class="activity-info mx-3">{{ $travelTreatmentActivity->user->name ?? '' }}</div>
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
                                    <button class="btn btn-outline-success mt-5 " href="{{ route('admin.travel-treatment-activities.edit', $travelTreatmentActivity->id) }}" data-toggle="modal" data-target="#travelTreatmentActivities_edit_modal">
                                        <i class="fa fa-pencil"></i> Düzenle
                                    </button>
                                    @endcan
                                    @can('travel_treatment_activity_delete')
                                    <form action="{{ route('admin.travel-treatment-activities.destroy', $travelTreatmentActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                                    <th>Dosya</th>
                                    <th>Yükleyen</th>
                                    <th>Açıklama</th>
                                    <th>Tarih</th>
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
               $(function() {
                   //   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                   $.extend(true, $.fn.dataTable.defaults, {
                       orderCellsTop: true,
                       order: [
                           [1, 'desc']
                       ],
                   });
                   let table = $('.datatable-travelTravelTreatmentActivities:not(.ajaxTable)').DataTable({
                       buttons: dtButtons
                   })
                   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                       $($.fn.dataTable.tables(true)).DataTable()
                           .columns.adjust();
                   });
               })

           </script>
       @endsection
