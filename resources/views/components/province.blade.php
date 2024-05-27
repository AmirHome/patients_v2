
<div class="{{$class}}">
    <div class="form-group">
        <select class="form-control select2 filter" id="countryId">
            <option value=null>Ülke</option>
            @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('country_id'){{ $message }}@enderror</span>
    </div>
</div>

<div class="{{$class}}">
    <div class="form-group">
        <select class="form-control select2 filter" id="city_id">
            <option>Şehir</option>
            @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('city_id'){{ $message }}@enderror</span>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.filter').select2();
    });

    
</script>