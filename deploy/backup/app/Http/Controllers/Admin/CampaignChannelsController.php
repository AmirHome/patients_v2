<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCampaignChannelRequest;
use App\Http\Requests\StoreCampaignChannelRequest;
use App\Http\Requests\UpdateCampaignChannelRequest;
use App\Models\CampaignChannel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CampaignChannelsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('campaign_channel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CampaignChannel::query()->select(sprintf('%s.*', (new CampaignChannel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'campaign_channel_show';
                $editGate      = 'campaign_channel_edit';
                $deleteGate    = 'campaign_channel_delete';
                $crudRoutePart = 'campaign-channels';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.campaignChannels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('campaign_channel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.campaignChannels.create');
    }

    public function store(StoreCampaignChannelRequest $request)
    {
        $campaignChannel = CampaignChannel::create($request->all());

        return redirect()->route('admin.campaign-channels.index');
    }

    public function edit(CampaignChannel $campaignChannel)
    {
        abort_if(Gate::denies('campaign_channel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.campaignChannels.edit', compact('campaignChannel'));
    }

    public function update(UpdateCampaignChannelRequest $request, CampaignChannel $campaignChannel)
    {
        $campaignChannel->update($request->all());

        return redirect()->route('admin.campaign-channels.index');
    }

    public function show(CampaignChannel $campaignChannel)
    {
        abort_if(Gate::denies('campaign_channel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignChannel->load('channelCampaignOrgs');

        return view('admin.campaignChannels.show', compact('campaignChannel'));
    }

    public function destroy(CampaignChannel $campaignChannel)
    {
        abort_if(Gate::denies('campaign_channel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignChannel->delete();

        return back();
    }

    public function massDestroy(MassDestroyCampaignChannelRequest $request)
    {
        $campaignChannels = CampaignChannel::find(request('ids'));

        foreach ($campaignChannels as $campaignChannel) {
            $campaignChannel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
