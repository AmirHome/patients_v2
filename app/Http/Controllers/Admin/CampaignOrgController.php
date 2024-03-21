<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCampaignOrgRequest;
use App\Http\Requests\StoreCampaignOrgRequest;
use App\Http\Requests\UpdateCampaignOrgRequest;
use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CampaignOrgController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('campaign_org_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CampaignOrg::with(['channel'])->select(sprintf('%s.*', (new CampaignOrg)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'campaign_org_show';
                $editGate      = 'campaign_org_edit';
                $deleteGate    = 'campaign_org_delete';
                $crudRoutePart = 'campaign-orgs';

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
            $table->addColumn('channel_title', function ($row) {
                return $row->channel ? $row->channel->title : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? CampaignOrg::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'channel']);

            return $table->make(true);
        }

        return view('admin.campaignOrgs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('campaign_org_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channels = CampaignChannel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.campaignOrgs.create', compact('channels'));
    }

    public function store(StoreCampaignOrgRequest $request)
    {
        $campaignOrg = CampaignOrg::create($request->all());

        return redirect()->route('admin.campaign-orgs.index');
    }

    public function edit(CampaignOrg $campaignOrg)
    {
        abort_if(Gate::denies('campaign_org_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channels = CampaignChannel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaignOrg->load('channel');

        return view('admin.campaignOrgs.edit', compact('campaignOrg', 'channels'));
    }

    public function update(UpdateCampaignOrgRequest $request, CampaignOrg $campaignOrg)
    {
        $campaignOrg->update($request->all());

        return redirect()->route('admin.campaign-orgs.index');
    }

    public function show(CampaignOrg $campaignOrg)
    {
        abort_if(Gate::denies('campaign_org_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignOrg->load('channel', 'campaignOrgPatients');

        return view('admin.campaignOrgs.show', compact('campaignOrg'));
    }

    public function destroy(CampaignOrg $campaignOrg)
    {
        abort_if(Gate::denies('campaign_org_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaignOrg->delete();

        return back();
    }

    public function massDestroy(MassDestroyCampaignOrgRequest $request)
    {
        $campaignOrgs = CampaignOrg::find(request('ids'));

        foreach ($campaignOrgs as $campaignOrg) {
            $campaignOrg->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
