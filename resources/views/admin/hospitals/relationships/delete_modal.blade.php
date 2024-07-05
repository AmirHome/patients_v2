<!-- GUIDE Modal Body -->
<div class="modal fade" id="delete_modal_hospitals" tabindex="-1" role="dialog"
    aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.hospitals.destroy', [0]) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-xs btn-danger submit" type="button">></button>
            </form>
        </div>
    </div>
</div>


@section('scripts')
@parent
    <script>
            $('#delete_modal_hospitals').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var rowId = button.data('id') ?? 0;

            $('#delete_modal_hospitals').on('click', 'button.submit[type="button"]', function() {
                // get form in this div
                var form =  $('#delete_modal_hospitals').find('form');
                
                form.attr('action', form.attr('action').replace('/0', '/' + rowId));
                form.submit();
            });
        });
    </script>
@endsection