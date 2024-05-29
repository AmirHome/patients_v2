@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.province.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.id') }}
                        </th>
                        <td>
                            {{ $province->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.country') }}
                        </th>
                        <td>
                            {{ $province->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.name') }}
                        </th>
                        <td>
                            {{ $province->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#city_patients" role="tab" data-toggle="tab">
                {{ trans('cruds.patient.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#city_hotels" role="tab" data-toggle="tab">
                {{ trans('cruds.hotel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="city_patients">
            @includeIf('admin.provinces.relationships.cityPatients', ['patients' => $province->cityPatients])
        </div>
        <div class="tab-pane" role="tabpanel" id="city_hotels">
            @includeIf('admin.provinces.relationships.cityHotels', ['hotels' => $province->cityHotels])
        </div>
    </div>
</div>

@endsection