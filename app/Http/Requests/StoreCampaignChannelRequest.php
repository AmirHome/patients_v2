<?php

namespace App\Http\Requests;

use App\Models\CampaignChannel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCampaignChannelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('campaign_channel_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
