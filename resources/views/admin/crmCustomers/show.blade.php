@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.show') }}  {{ trans('cruds.crmCustomer.title') }} </span>
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.faq-questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.crmCustomer.fields.first_name') }}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->first_name }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">  {{ trans('cruds.crmCustomer.fields.last_name') }}

                            </div>
                            <span class="show-header-text ml-1"> {{ $crmCustomer->last_name }} 

                            </span>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.email')}}

                            </div>
                            <span class="show-header-text ml-1"> {{ $crmCustomer->email }}

                            </span>
                        </div>

                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">                          {{trans('cruds.crmCustomer.fields.phone')}}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->phone }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.email')}}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->email }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.birthday')}}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->birthday }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.campaign')}}
                            </div>
                            <span class="show-header-text ml-1">{{ ($crmCustomer->campaign->channel->title ?? '') . ' '. ($crmCustomer->campaign->title ?? '') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4"> {{trans('cruds.crmCustomer.fields.website')}}</div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->website }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.skype')}}</div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->skype }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                <div class="col-md-4">
                <div class="text-left">
                            <div class="show-header ml-4"> {{trans('cruds.crmCustomer.fields.user')}}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->user->name ?? '' }}
                            </span>
                        </div>
                        </div>
                        <div class="col-md-4">
                <div class="text-left">
                            <div class="show-header ml-4">{{trans('cruds.crmCustomer.fields.status')}}
                            </div>
                            <span class="show-header-text ml-1">{{ $crmCustomer->status->name ?? '' }}
                            </span>
                        </div>
                        </div>
                        <div class="col-md-4">
                <div class="text-left">
                            <div class="show-header ml-4"> {{trans('cruds.crmCustomer.fields.city')}}
                            </div>
                            <span class="show-header-text ml-1">{{ ($crmCustomer->city->country->name ?? '') . ' ' .( $crmCustomer->city->name ?? '') }}
                            </span>
                        </div>
                        </div>
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                <div class="col-md-6">
                        <div class="text-left show-desc-header">{{trans('cruds.crmCustomer.fields.address')}}
                        </div>
                        <span class="show-header-desc-text">  {{ $crmCustomer->address }}
                        </span>
                    </div>
                    <div class="col-md-5 ml-5">
                        <div class="text-left show-desc-header"> {{ trans('cruds.crmCustomer.fields.description') }}
                        </div>
                        <span class="show-header-desc-text"> {{ $crmCustomer->description }} 
                        </span>
                    </div>
                  
                </div>
               
            </div>
        </div>
        </div>



    @includeIf('admin.crmCustomers.relationships.customerCrmDocuments', ['crmDocuments' => $crmCustomer->customerCrmDocuments])


@endsection