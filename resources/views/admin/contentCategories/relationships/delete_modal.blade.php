<!-- GUIDE Modal Body -->
<div class="modal fade" id="delete_modal_content-categories" tabindex="-1" role="dialog"
    aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:30vh;">
            <form action="{{ route('admin.content-categories.destroy', [0]) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-header mt-2" style="font-size: 1.2rem;">Silmek istediğinize emin misiniz?</div>
                <div class="row">
                    <h6 class="welcome-under-text mx-3">Bu İşlem Geri Alınamaz...</h6><br><br>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group" style="padding-right:3px;">
                        <button type="button" class="btn-no" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.no') }}
                        </button>
                    </div>
                    <div class="form-group" style="padding-left:0px;">
                        <button class="btn-yes btn btn-xs  submit" type="button">{{ trans('global.yes') }}</button>
                    </div>
                </div>                
            </form>
        </div>
    </div>
</div>


@section('scripts')
@parent
    <script>
            $('#delete_modal_content-categories').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var rowId = button.data('id') ?? 0;

            $('#delete_modal_content-categories').on('click', 'button.submit[type="button"]', function() {
                // get form in this div
                var form =  $('#delete_modal_content-categories').find('form');
                
                form.attr('action', form.attr('action').replace('/0', '/' + rowId));
                form.submit();
            });
        });
    </script>
@endsection