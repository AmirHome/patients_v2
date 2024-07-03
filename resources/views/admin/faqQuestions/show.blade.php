@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ trans('global.show') }} {{ trans('cruds.faqQuestion.title') }}</span>
        <div class="form-group mb-0">
            <a class="btn btn-default" href="{{ url('admin.expenses-incomes.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
   
        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
             <div class="show-header"> <i class="fas fa-tag pr-1"></i>  {{ trans('cruds.faqQuestion.fields.category') }}</div>
                 <span class="show-header-text"> {{ $faqQuestion->category->category ?? '' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-left">
                <div class="show-header"> <i class="fas fa-question-circle pr-1"></i> {{ trans('cruds.faqQuestion.fields.question') }}</div>
                  <span class="show-header-text"> {{ $faqQuestion->question }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-5">
            <div class="dotted-border">
            </div>
        </div>
        <div class="row">
        <div class="col-md-12 ml-4">
        <div class="text-left show-desc-header">
 {{ trans('cruds.faqQuestion.fields.answer') }}
</div>
<span class="show-header-desc-text">  {!! $faqQuestion->answer !!}</span>
                            </div>
                            </div>

        </div>
    </div>
</div>
</div>


@endsection