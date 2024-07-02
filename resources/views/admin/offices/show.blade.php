@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span> {{ trans('global.show') }} {{ trans('cruds.office.title') }}</span>
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.faq-questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.office.fields.id') }}</div>
                            <span class="show-header-text ml-1">{{ $office->id }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.office.fields.fax') }}</div>
                            <span class="show-header-text ml-1">{{ $office->fax }}</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.office.fields.name') }}</div>
                            <span class="show-header-text ml-1">                            {{ $office->name }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.office.fields.phone') }}
                            </div>
                            <span class="show-header-text ml-1">                            {{ $office->phone }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.office.fields.city') }}
                            </div>
                            <span class="show-header-text ml-1"> {{ $office->city->name ?? '' }}</span>
                        </div>
                    </div>
                  
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-12">
                        <div class="text-left show-desc-header">                            {{ trans('cruds.office.fields.address') }}
                        </div>
                        <span class="show-header-desc-text">                            {{ $office->address }}
                        </span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection