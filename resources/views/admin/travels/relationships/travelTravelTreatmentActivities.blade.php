       <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-travelTravelTreatmentActivities">
                <thead class="d-none">
                    <tr >
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
                    @foreach($travelTreatmentActivities as $key => $travelTreatmentActivity)
                        <tr data-entry-id="{{ $travelTreatmentActivity->id }}">
                            
                        <td style="max-width: 100px; width: 100px; text-align: center;">
                        <div class="d-flex justify-content-center">
                         <span style='font-size:30px;border: 1px solid #00b8d9;color: white !important;border-radius:50%;min-width:50px;background-color:#00b8d9'>{{ $key + 1 }}</span>
                           </div>
                            </td>

                            <td>
                                <h5 class="activity-title">{{ $travelTreatmentActivity->status->title ?? '' }}</h5>
                                <div class="activity-info">
                                    <i class="fas fa-user"></i> &nbsp; {{ $travelTreatmentActivity->user->name ?? '' }}&nbsp;  - &nbsp;  {{ $travelTreatmentActivity->user->email ?? '' }}&nbsp;  - &nbsp; <span>{{ $travelTreatmentActivity->created_at ?? '' }}</span>

                                </div>             
                                @if (!empty($travelTreatmentActivity->description))
         <div class="activity-desc">
         <pre><i class="fas fa-comments"></i> {{ $travelTreatmentActivity->description }}</pre>
               </div>
@endif
                                
                                @foreach($travelTreatmentActivity->treatment_file as $key => $media)
                                <div class="activity-files">
                                <div style="display: flex; align-items: center;">
    <i class="fas fa-file-medical-alt" style="margin-right: 5px;"></i> {{ $key + 1 }}. Dosyayı Görütülemek için &nbsp;
    <a href="{{ $media->getUrl() }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: 500;">
        {{ trans('global.view_file') }}
    </a> &nbsp;&nbsp;

</div>

                                </div>
                                @endforeach
                            </td>
                            <td>
                                @can('travel_treatment_activity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.travel-treatment-activities.show', $travelTreatmentActivity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('travel_treatment_activity_edit')
                                    <button class="btn btn-xs btn-info" href="{{ route('admin.travel-treatment-activities.edit', $travelTreatmentActivity->id) }}"  data-toggle="modal" data-target="#travelTreatmentActivities_edit_modal">
                                        {{ trans('global.edit') }}
                                 </button>
                                @endcan

                                @can('travel_treatment_activity_delete')
                                    <form action="{{ route('admin.travel-treatment-activities.destroy', $travelTreatmentActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="travelTreatmentActivities_edit_modal" tabindex="-1" role="dialog"
    aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route("admin.travel-treatment-activities.update", [$travelTreatmentActivity->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="travel_id" value="{{ $travelTreatmentActivity->id }}">
                <div class="card-header text-left mx-3 mt-2">Edit Travel Treatment</div>

                <div class="col-md-12">

            <div class="form-group">
                <label for="description">{{ trans('cruds.travelTreatmentActivity.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $travelTreatmentActivity->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.description_helper') }}</span>
            </div>
            </div>

            <div class="col-md-12">
            <div class="form-group" wire:ignore>
                <label class="required" for="treatment_file">Dosya Yükle (max:10mb pdf-excel-word-zip-img)</label>
                <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }} treatment_file-dropzone" id="treatment_file-dropzone">
                    <div class="dz-message" data-dz-message><span>Drop or Select file</span></div>
                    <div class="dz-message" data-dz-message>
                        <p>Drop files here or click <a>browse</a> through your machine</p>
                    </div>
                </div>
                @if($errors->has('treatment_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('treatment_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper') }}</span>
            </div>
        </div>
            <div class="row justify-content-end">
        <div class="form-group">
            <button type="button" class="btn btn-outline-primary" id="cancelButton2">{{ trans('global.cancel') }}</button>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
        </div>
</div>
            </form>
        </div>
    </div>


@section('scripts')
@parent
<script>
    $(function () {
//   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
  });
  let table = $('.datatable-travelTravelTreatmentActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

var uploadedTreatmentFileMap = {}
Dropzone.options.treatmentFileDropzone = {
    url: '{{ route('admin.travel-treatment-activities.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="treatment_file[]" value="' + response.name + '">')
      uploadedTreatmentFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTreatmentFileMap[file.name]
      }
      $('form').find('input[name="treatment_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($travelTreatmentActivity) && $travelTreatmentActivity->treatment_file)
          var files =
            {!! json_encode($travelTreatmentActivity->treatment_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="treatment_file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

$(document).ready(function() {
    $('#cancelButton2').click(function() {
         var modal = $('#travelTreatmentActivities_edit_modal');
        modal.removeClass('show').css('display', 'none');
        modal.attr('aria-hidden', 'true');
        
         modal.removeAttr('role').removeAttr('aria-modal');
        
         $('body').removeClass('modal-open');
        
         $('.modal-backdrop').remove();
        
    });
});


</script>
@endsection