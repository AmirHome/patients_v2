<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Models\CampaignOrg;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\Province;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\DataTablesFilterTrait;
use App\Models\CampaignChannel;
use App\Models\Country;

class CrmCustomerController extends Controller
{
    use DataTablesFilterTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->crmMountFilter();

        if ($request->ajax()) {
            $query = CrmCustomer::with(['status', 'city.country', 'campaign.channel', 'user'])
                                    ->select(sprintf('%s.*', (new CrmCustomer)->table));
            
            $query = $this->crmFilter($request, $query);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'crm_customer_show';
                $editGate      = 'crm_customer_edit';
                $deleteGate    = 'crm_customer_delete';
                $crudRoutePart = 'crm-customers';

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

            $table->addColumn('full_name', function ($user) {
                return $user->first_name . ' ' . $user->last_name;
            })->filterColumn('full_name', function($query, $keyword) {
                $sql = "CONCAT(first_name, ' ', last_name) LIKE ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->orderColumn('full_name', function ($query, $order) {
                $query->orderByRaw("CONCAT(first_name, ' ', last_name) $order");
            });
            
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });

            $table->addColumn('city_name', function ($row) {
                //return $row->city ? $row->city->name : '';
                return $row->city ? $row->city->country->name . ' ' . $row->city->name : '';
            })->filterColumn('city_name', function($query, $keyword) {
                $query->whereHas('city', function($query) use ($keyword) {
                    $query->whereHas('country', function($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    })->orWhere('name', 'like', "%{$keyword}%");
                });
            })->orderColumn('city_name', function ($query, $order) {
                $query->orderBy(Province::select('name')
                         ->whereColumn('provinces.id', 'city_id'), $order);
            });

            $table->addColumn('campaign_title', function ($row) {
                return $row->campaign ?  $row->campaign->title . ' ' . $row->campaign->channel->title : '';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });



            // $table->editColumn('campaign.started_at', function ($row) {
            //     return $row->campaign ? (is_string($row->campaign) ? $row->campaign : $row->campaign->started_at) : '';
            // });
            // $table->addColumn('user_name', function ($row) {
            //     return $row->user ? $row->user->name : '';
            // });

            // $table->editColumn('user.email', function ($row) {
            //     return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            // });

            $table->rawColumns(['actions', 'placeholder', 'status', 'city', 'campaign', 'user']);

            return $table->make(true);
        }

        return view('admin.crmCustomers.index', $data);
    }

    public function create()
    {
        abort_if(Gate::denies('crm_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = CampaignOrg::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::isActive()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crmCustomers.create', compact('campaigns', 'cities', 'statuses', 'users'));
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        return redirect()->route('admin.crm-customers.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = CampaignOrg::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::isActive()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crmCustomer->load('status', 'city', 'campaign', 'user');

        return view('admin.crmCustomers.edit', compact('campaigns', 'cities', 'crmCustomer', 'statuses', 'users'));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $crmCustomer->update($request->all());

        return redirect()->route('admin.crm-customers.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // GUIDE Modal Controller
        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $crmCustomer->load('status', 'city', 'campaign', 'user', 'customerCrmDocuments');

        return view('admin.crmCustomers.show', compact('crmCustomer', 'statuses'));
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrmCustomerRequest $request)
    {
        $crmCustomers = CrmCustomer::find(request('ids'));

        foreach ($crmCustomers as $crmCustomer) {
            $crmCustomer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
