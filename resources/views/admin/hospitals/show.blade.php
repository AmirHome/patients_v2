@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hospital.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.id') }}
                        </th>
                        <td>
                            {{ $hospital->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.name') }}
                        </th>
                        <td>
                            {{ $hospital->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.email') }}
                        </th>
                        <td>
                            {{ $hospital->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.phone') }}
                        </th>
                        <td>
                            {{ $hospital->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.fax') }}
                        </th>
                        <td>
                            {{ $hospital->fax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.address') }}
                        </th>
                        <td>
                            {{ $hospital->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection