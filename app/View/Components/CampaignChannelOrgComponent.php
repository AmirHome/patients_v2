<?php

namespace App\View\Components;

use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignChannelOrgComponent extends Component
{
    private $data;
    private $class;

    public function __construct($class, $data)
    {
        $this->data = $data;
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        $campaignChannels = CampaignChannel::get()->pluck('title', 'id');
        $campaignOrgs = CampaignOrg::where('channel_id', $this->data->channel_id??0)->where('status', 1)->get();
        $class = $this->class;
        return view('components.'.($this->data->template ?? 'campaign-channel-org').'-component', compact('campaignChannels', 'campaignOrgs', 'class'));
    }
}
