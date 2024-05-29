<?php

namespace App\Http\Requests;

use App\Models\CampaignOrg;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCampaignOrgRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('campaign_org_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:campaign_orgs,id',
        ];
    }
}
