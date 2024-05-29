<?php

namespace App\Http\Requests;

use App\Models\CampaignOrg;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCampaignOrgRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('campaign_org_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'channel_id' => [
                'required',
                'integer',
            ],
            'started_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
