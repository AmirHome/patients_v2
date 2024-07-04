<div class="modal fade" id="create-campaign-orgs" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.campaign-orgs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Campaign Orgs</div>
            <div class="row">
                <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.campaignOrg.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title..." type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignOrg.fields.title_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="channel_id">{{ trans('cruds.campaignOrg.fields.channel') }}</label>
                <select class="form-control select2 {{ $errors->has('channel') ? 'is-invalid' : '' }}" name="channel_id" id="channel_id" required>
                    @foreach($channels as $id => $entry)
                        <option value="{{ $id }}" {{ old('channel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignOrg.fields.channel_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="started_at">{{ trans('cruds.campaignOrg.fields.started_at') }}</label>
                <input class="form-control date {{ $errors->has('started_at') ? 'is-invalid' : '' }}" type="text" name="started_at" id="started_at" value="{{ old('started_at') }}" required>
                @if($errors->has('started_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('started_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignOrg.fields.started_at_helper') }}</span>
            </div>
            </div>
            </div>
           <div class="row ml-2">
            <div class="col-md-2">
            <div class="form-group">
                <label class="required radio-btn-header">{{ trans('cruds.campaignOrg.fields.status') }}</label>
                @foreach(App\Models\CampaignOrg::STATUS_RADIO as $key => $label)
                <div class="row mb-4">
                    <div class=" form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input mt-4 radio-btn" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label mt-3 radio-btn-text" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                    </div>

                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignOrg.fields.status_helper') }}</span>
            </div>
            </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger float-right mb-5" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>



