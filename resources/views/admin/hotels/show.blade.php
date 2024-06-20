@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hotel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hotels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.id') }}
                        </th>
                        <td>
                            {{ $hotel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.name') }}
                        </th>
                        <td>
                            {{ $hotel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.location') }}
                        </th>
                        <td>
                            {{ $hotel->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.price') }}
                        </th>
                        <td>
                            {{ $hotel->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.country') }}
                        </th>
                        <td>
                            {{ $hotel->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotel.fields.city') }}
                        </th>
                        <td>
                            {{ $hotel->city->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
      
        </div>
    </div>
</div>



@endsection