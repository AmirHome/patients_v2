@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.translator.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.translators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.translator.fields.id') }}
                        </th>
                        <td>
                            {{ $translator->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.translator.fields.title') }}
                        </th>
                        <td>
                            {{ $translator->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.translator.fields.email') }}
                        </th>
                        <td>
                            {{ $translator->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.translator.fields.phone') }}
                        </th>
                        <td>
                            {{ $translator->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.translator.fields.city') }}
                        </th>
                        <td>
                            {{ $translator->city->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.translators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection