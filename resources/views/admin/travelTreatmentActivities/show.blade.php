@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.travelTreatmentActivity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-treatment-activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.id') }}
                        </th>
                        <td>
                            {{ $travelTreatmentActivity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.user') }}
                        </th>
                        <td>
                            {{ $travelTreatmentActivity->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.travel') }}
                        </th>
                        <td>
                            {{ $travelTreatmentActivity->travel->reffering_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.status') }}
                        </th>
                        <td>
                            {{ $travelTreatmentActivity->status->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.description') }}
                        </th>
                        <td>
                            {{ $travelTreatmentActivity->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}
                        </th>
                        <td>
                            @foreach($travelTreatmentActivity->treatment_file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection