<div>
    
    <label for="">Countery</label>
    <select class="form-control form-text-input filter">
        <option value=null>Select a country</option>
        @foreach ($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
    <span class="text-danger">@error('country_id'){{ $message }}@enderror</span>

</div>