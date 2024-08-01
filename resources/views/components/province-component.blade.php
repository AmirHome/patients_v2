{{-- <x-province-component class="col-md-4" :data="['template'=>'province', 'province_id'=>'10']"/> --}}
<div class="{{$class}}">
    <div class="form-group">
    <label for="">{{ trans('cruds.travel.fields.country') }}</label>
        <select class="form-control select2 filter" id="country_id">
            <option value=null></option>
            @foreach ($countries as $id => $name)
            <option value="{{ $id }}" {{($id==$country)?'selected':''}}>{{ $name }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('country_id'){{ $message }}@enderror</span>
    </div>
</div>

<div class="{{$class}}">
    <div class="form-group">
    <label for="">{{ trans('cruds.travel.fields.city') }}</label>
        <select class="form-control select2 filter" id="city_id">
            <option> </option>
            @foreach ($cities as $id => $name)
            <option value="{{ $id }}" {{($id==$city)?'selected':''}}>{{ $name }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('city_id'){{ $message }}@enderror</span>
    </div>
</div>

@section('scripts')
@parent
<script>

    $('#country_id').on('change', function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                url: "{{ route('admin.ajax.provinces.index', ['country' => ':param']) }}".replace(':param', countryId),
                type: 'GET',
                success: function(data) {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>');
                    $.each(data.provinces, function(key, value) {
                        $('#city_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Select City</option>');
            }

        });
</script>
@endsection
