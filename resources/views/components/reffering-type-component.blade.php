{{-- 
    <x-reffering-type-component class="col-md-4" :data="['reffering'=>7, 'reffering_type'=>'Doctor']"/>
--}}
<div class="{{$class}}">
    <div class="form-group">
    <label for="">Referans Tipiniz</label>
        <select class="form-control" name="reffering_type">
            <option value="" selected> </option>
            @foreach ($refferingTypes as $id => $title)
            <option value="{{ $id }}" {{($id==$refferingType)?'selected':''}}>{{ $title }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('reffering_type'){{ $message }}@enderror</span>
    </div>
</div>

<div class="{{$class}}">
    <div class="form-group">
    <label for="">Referansınız</label>
        
        <input type="text" class="form-control {{$refferingType == 'Other'?'':'d-none'}}" placeholder="Enter reffering" name="reffering" id="reffer-other" value="{{$reffering??''}}">

        <select class="form-control {{($refferingType != 'Other' && $refferingType != 'Phone')?'':'d-none'}}" name="reffering" id="reffer-select">
            <option value="" selected> </option>
            @foreach ($refferingIds as $id => $refferings)
            <option value="{{ $id }}" {{($id==$reffering)?'selected':''}}>{{ $refferings }}</option>
            @endforeach
        </select>

        <span class="text-danger">@error('reffering'){{ $message }}@enderror</span>
    </div>
</div>


@section('scripts')
@parent
<script>

    $('select[name="reffering_type"]').on('change', function() {
            var id = $(this).val();
            var reffering = $('[name="reffering"]');
            reffering.empty();
            $('#reffer-other').removeClass('d-none');
            $('#reffer-select').removeClass('d-none');
            if (id =='Phone'){
                $('#reffer-other').addClass('d-none');
                $('#reffer-select').addClass('d-none');
            }else{
                if (id!='Other') {
                    $('#reffer-other').addClass('d-none');
                    $.ajax({
                        url: "{{ route('admin.ajax.travel-reffering.index', ['type' => ':param']) }}".replace(':param', id),
                        type: 'GET',
                        success: function(data) {
                            reffering.append('<option value="">Select ..</option>');
                            $.each(data, function(key, value) {
                                reffering.append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#reffer-select').addClass('d-none');
                    reffering.append('<option value="">Select ..</option>');
                }
            }

        });
</script>
@endsection