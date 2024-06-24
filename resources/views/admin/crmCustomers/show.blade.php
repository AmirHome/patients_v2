@extends('layouts.admin')
@section('content')

<div class="card">


    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.crm-customers.index') }}">
                    <i class="fa fa-arrow-left"></i> {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                        <label for=""> {{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                        <div>{{ $crmCustomer->first_name }}</div>
                </div>
                <div class="col-md-3">
                    <label for="">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                    <div> {{ $crmCustomer->last_name }} </div>
                </div>
                <div class="col-md-3">
                    <label for="phone">{{trans('cruds.crmCustomer.fields.phone')}}</label>
                    <div>{{ $crmCustomer->phone }}</div>
                </div>
                <div class="col-md-3">
                    <label for="email">{{trans('cruds.crmCustomer.fields.email')}}</label>
                    <div>{{ $crmCustomer->email }}</div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                    <label for="birthday">{{trans('cruds.crmCustomer.fields.birthday')}}</label>
                    <div>{{ $crmCustomer->birthday }}</div>
                </div>
                <div class="col-md-3">
                    <label for="skype">{{trans('cruds.crmCustomer.fields.skype')}}</label>
                    <div>{{ $crmCustomer->skype }}</div>
                </div>
                <div class="col-md-3">
                    <label for="website">{{trans('cruds.crmCustomer.fields.website')}}</label>
                    <div>{{ $crmCustomer->website }}</div>
                </div>
                <div class="col-md-3">
                    <label for="address">{{trans('cruds.crmCustomer.fields.campaign')}}</label>
                    <div>{{ ($crmCustomer->campaign->channel->title ?? '') . ' '. ($crmCustomer->campaign->title ?? '') }}</div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="address">{{trans('cruds.crmCustomer.fields.address')}}</label>
                    <div>{{ $crmCustomer->address }}</div>
                </div>
                <div class="col-md-6">
                    <label for="discription">{{ trans('cruds.crmCustomer.fields.description') }}</label>
                    <div>{{ $crmCustomer->description }}</div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-5">
                    <label for="status">{{trans('cruds.crmCustomer.fields.status')}}</label>
                    <div>{{ $crmCustomer->status->name ?? '' }}</div>
                </div>
                <div class="col-md-4">
                    <label for="city">{{trans('cruds.crmCustomer.fields.city')}}</label>
                    <div>{{ ($crmCustomer->city->country->name ?? '') . ' ' .( $crmCustomer->city->name ?? '') }}</div>
                </div>
                <div class="col-md-3">
                    <label for="user">{{trans('cruds.crmCustomer.fields.user')}}</label>
                    <div>{{ $crmCustomer->user->name ?? '' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>


    @includeIf('admin.crmCustomers.relationships.customerCrmDocuments', ['crmDocuments' => $crmCustomer->customerCrmDocuments])


@endsection