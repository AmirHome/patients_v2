@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.show') }}  {{ trans('cruds.contentPage.title') }}</span>
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.content-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.contentPage.fields.id') }}
                            </div>
                            <span class="show-header-text ml-1">                            {{ $contentPage->id }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                               {{ trans('cruds.contentPage.fields.tag') }}
                            </div>
                            <span class="show-header-text ml-1">                   
                            @foreach($contentPage->tags as $key => $tag)
                                <span>{{ $tag->name }}</span>
                            @endforeach
                            </span>
                        </div>
                    </div>
                   
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                                                      {{ trans('cruds.contentPage.fields.title') }}

                            </div>
                            <span class="show-header-text ml-1">                                                  {{ $contentPage->title }}

                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4"> 
                            {{ trans('cruds.contentPage.fields.category') }}

                            </div>
                            <span class="show-header-text ml-1">                            @foreach($contentPage->categories as $key => $category)
                            <span >{{ $category->name }}</span>
                            @endforeach
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                                                           {{ trans('cruds.contentPage.fields.excerpt') }}
                            </div>
                            <span class="show-header-text ml-1">                   
                            {{ $contentPage->excerpt }}
                            </span>
                        </div>
                    </div>
                    </div>

                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-6">
                        <div class="text-left show-desc-header">                              {{ trans('cruds.contentPage.fields.page_text') }}
                        </div>
                        <span class="show-header-desc-text">   {!! $contentPage->page_text !!}</span>
                        </div>
                        <div class="col-md-5 ml-4">
                        <div class="text-left show-desc-header">                            {{ trans('cruds.contentPage.fields.featured_image') }}

                        </div>
                        <span class="show-header-desc-text"> @if($contentPage->featured_image)
                                <a href="{{ $contentPage->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contentPage->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection