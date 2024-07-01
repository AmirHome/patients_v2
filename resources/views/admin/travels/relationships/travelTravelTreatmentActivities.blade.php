       <div class="table-responsive">
           <table
               class="table table-bordered table-striped table-hover datatable datatable-travelTravelTreatmentActivities">
               <thead class="d-none">
                   <tr>
                       <th width="10">

                       </th>
                       <th>
                           {{ trans('cruds.travelTreatmentActivity.fields.travel') }}

                           {{ trans('cruds.travel.fields.reffering') }}

                           {{ trans('cruds.travelTreatmentActivity.fields.status') }}

                           {{ trans('cruds.travelTreatmentActivity.fields.description') }}

                           {{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}
                       </th>
                       <th>
                           &nbsp;
                       </th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($travelTreatmentActivities as $key => $travelTreatmentActivity)
                       <tr data-entry-id="{{ $travelTreatmentActivity->id }}">

                           <td style="max-width: 100px; width: 100px; text-align: center;">
                               <div class="d-flex justify-content-center">
                                   <span
                                       style='font-size:30px;border: 1px solid #00b8d9;color: white !important;border-radius:50%;min-width:50px;background-color:#00b8d9'>{{ $key + 1 }}</span>
                               </div>
                           </td>

                           <td>
                               <h5 class="activity-title">{{ $travelTreatmentActivity->status->title ?? '' }}</h5>
                               <div class="activity-info">
                                   <i class="fas fa-user"></i> &nbsp;
                                   {{ $travelTreatmentActivity->user->name ?? '' }}&nbsp; - &nbsp;
                                   {{ $travelTreatmentActivity->user->email ?? '' }}&nbsp; - &nbsp;
                                   <span>{{ $travelTreatmentActivity->created_at ?? '' }}</span>

                               </div>
                               @if (!empty($travelTreatmentActivity->description))
                                   <div class="activity-desc">
                                       <pre><i class="fas fa-comments"></i> {{ $travelTreatmentActivity->description }}</pre>
                                   </div>
                               @endif

                               @foreach ($travelTreatmentActivity->treatment_file as $key => $media)
                                   <div class="activity-files">
                                       <div style="display: flex; align-items: center;">
                                           <i class="fas fa-file-medical-alt" style="margin-right: 5px;"></i>
                                           {{ $key + 1 }}. Dosyayı Görütülemek için &nbsp;
                                           <a href="{{ $media->getUrl() }}" target="_blank"
                                               style="text-decoration: none; color: #007bff; font-weight: 500;">
                                               {{ trans('global.view_file') }}
                                           </a> &nbsp;&nbsp;

                                       </div>

                                   </div>
                               @endforeach
                           </td>
                           <td>
                               @can('travel_treatment_activity_show')
                                   <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.travel-treatment-activities.show', $travelTreatmentActivity->id) }}">
                                       {{ trans('global.view') }}
                                   </a>
                               @endcan

                               @can('travel_treatment_activity_edit')
                                   <button class="btn btn-xs btn-info"
                                       href="{{ route('admin.travel-treatment-activities.edit', $travelTreatmentActivity->id) }}"
                                       data-toggle="modal" data-target="#travelTreatmentActivities_edit_modal">
                                       {{ trans('global.edit') }}
                                   </button>
                               @endcan

                               @can('travel_treatment_activity_delete')
                                   <form
                                       action="{{ route('admin.travel-treatment-activities.destroy', $travelTreatmentActivity->id) }}"
                                       method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                       style="display: inline-block;">
                                       <input type="hidden" name="_method" value="DELETE">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <input type="submit" class="btn btn-xs btn-danger"
                                           value="{{ trans('global.delete') }}">
                                   </form>
                               @endcan
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
