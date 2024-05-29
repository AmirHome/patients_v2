<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignOrgRequest;
use App\Http\Requests\UpdateCampaignOrgRequest;
use App\Http\Resources\Admin\CampaignOrgResource;
use App\Models\CampaignOrg;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignOrgApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('campaign_org_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignOrgResource(CampaignOrg::with(['channel'])->get());
    }

    public function store(StoreCampaignOrgRequest $request)
    {
        $campaignOrg = CampaignOrg::create($request->all());

        return (new CampaignOrgResource($campaignOrg))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CampaignOrg $campaignOrg)
    {
        abort_if(Gate::denies('campaign_org_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignOrgResource($campaignOrg->load(['channel']));
    }

    public function update(UpdateCampaignOrgRequest $request, CampaignOrg $campaignOrg)
    {
        $campaignOrg->update($request->all());

        return (new CampaignOrgResource($campaignOrg))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CampaignOrg $campaignOrg)
    {
        abort_if(Gate::denies('campaign_org_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignOrg->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
