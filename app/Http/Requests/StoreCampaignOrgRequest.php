<?php

namespace App\Http\Requests;

use App\Models\CampaignOrg;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCampaignOrgRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('campaign_org_create');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
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
