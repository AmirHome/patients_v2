<?php

namespace App\View\Components;

use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignChannelOrgComponent extends Component
{
    private $data;//campaign_org_id
    private $class;
    private $template;

    public function __construct($class, $data)
    {

        $this->data = $data['campaign_org_id']??0;
        $this->template = $data['template']??'campaign-channel-org';
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        $campaignChannels = CampaignChannel::get()->pluck('title', 'id');
        $campaignOrg = $this->data??0;
        $campaignChannel = CampaignOrg::where('status', 1)->find($campaignOrg)->channel_id??0;
        $campaignOrgs = CampaignOrg::where('status', 1)->where('channel_id', $campaignChannel)->get()->pluck('title', 'id');

        $class = $this->class;
        return view('components.'.$this->template.'-component', compact('campaignChannels', 'campaignOrgs', 'class', 'campaignOrg', 'campaignChannel'));
    }
}
