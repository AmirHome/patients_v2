{{-- 
    <x-campaign-channel-org-component class="col-md-4" :data="['template'=>'campaign-channel-org', 'campaign_org_id'=>2]"/>
--}}
<div class="{{$class}}">
    <div class="form-group">
    <label for="">Channel</label>
        <select class="form-control select2 filter" id="channel_id">
            <option value=null>Channel</option>
            @foreach ($campaignChannels as $id => $title)
            <option value="{{ $id }}" {{($id==$campaignChannel)?'selected':''}}>{{ $title }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('channel_id'){{ $message }}@enderror</span>
    </div>
</div>

<div class="{{$class}}">
    <div class="form-group">
    <label for="">Organ</label>
        <select class="form-control select2 filter" id="campaign_org_id">
            <option>Organ</option>
            @foreach ($campaignOrgs as $id => $title)
            <option value="{{ $id }}"  {{($id==$campaignOrg)?'selected':''}}>{{ $title }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('campaign_org_id'){{ $message }}@enderror</span>
    </div>
</div>

@section('scripts')
@parent
<script>

    $('#channel_id').on('change', function() {
            var id = $(this).val();
            var org = $('#campaign_org_id');
            if (id) {
                $.ajax({
                url: "{{ route('admin.ajax.campaign.index', ['channel' => ':param']) }}".replace(':param', id),
                type: 'GET',
                success: function(data) {
                    org.empty();
                    org.append('<option value="">Select ..</option>');
                    $.each(data, function(key, value) {
                        org.append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            } else {
                org.empty();
                org.append('<option value="">Select ..</option>');
            }

        });
</script>
@endsection
