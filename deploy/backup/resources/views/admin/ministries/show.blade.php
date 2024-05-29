@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ministry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ministries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ministry.fields.id') }}
                        </th>
                        <td>
                            {{ $ministry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ministry.fields.name') }}
                        </th>
                        <td>
                            {{ $ministry->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ministry.fields.code') }}
                        </th>
                        <td>
                            {{ $ministry->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ministry.fields.code_inc') }}
                        </th>
                        <td>
                            {{ $ministry->code_inc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ministries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection