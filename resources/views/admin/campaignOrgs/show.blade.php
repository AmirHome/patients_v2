@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.campaignOrg.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.campaign-orgs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.id') }}
                        </th>
                        <td>
                            {{ $campaignOrg->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.title') }}
                        </th>
                        <td>
                            {{ $campaignOrg->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.channel') }}
                        </th>
                        <td>
                            {{ $campaignOrg->channel->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.started_at') }}
                        </th>
                        <td>
                            {{ $campaignOrg->started_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CampaignOrg::STATUS_RADIO[$campaignOrg->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.campaign-orgs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection