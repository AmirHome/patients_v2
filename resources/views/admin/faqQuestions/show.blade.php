@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ trans('global.show') }} {{ trans('cruds.faqQuestion.title') }}</span>
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
                <div class="text-center">
             <div class="show-header-text">    <i class="fas fa-tag"></i>  {{ trans('cruds.faqQuestion.fields.category') }}</div>
                    <br>
                    {{ $faqQuestion->category->category ?? '' }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                <div class="show-header-text">  <i class="fas fa-question-circle"></i> {{ trans('cruds.faqQuestion.fields.question') }}</div>
                    <br>
                    {{ $faqQuestion->question }}
                </div>
            </div>
        </div>
                        
        <div class="row pt-5">
        <div class="col-md-12">
        <div class="text-center">
 {{ trans('cruds.faqQuestion.fields.answer') }}
                            <br>
                            {!! $faqQuestion->answer !!}
                            </div>
                            </div>
                            </div>

        </div>
    </div>
</div>
</div>


@endsection