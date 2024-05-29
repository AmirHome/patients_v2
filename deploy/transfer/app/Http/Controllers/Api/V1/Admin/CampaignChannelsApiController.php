<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignChannelRequest;
use App\Http\Requests\UpdateCampaignChannelRequest;
use App\Http\Resources\Admin\CampaignChannelResource;
use App\Models\CampaignChannel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignChannelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('campaign_channel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignChannelResource(CampaignChannel::all());
    }

    public function store(StoreCampaignChannelRequest $request)
    {
        $campaignChannel = CampaignChannel::create($request->all());

        return (new CampaignChannelResource($campaignChannel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CampaignChannel $campaignChannel)
    {
        abort_if(Gate::denies('campaign_channel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignChannelResource($campaignChannel);
    }

    public function update(UpdateCampaignChannelRequest $request, CampaignChannel $campaignChannel)
    {
        $campaignChannel->update($request->all());

        return (new CampaignChannelResource($campaignChannel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CampaignChannel $campaignChannel)
    {
        abort_if(Gate::denies('campaign_channel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignChannel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
