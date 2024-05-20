@extends('layouts.app')
@section('content')


        {{ trans('cruds.travelTreatmentActivity.title') }}


        @includeIf('admin.travels.relationships.travelTravelTreatmentActivities', ['travelTreatmentActivities' => $travel->travelTravelTreatmentActivities])



@endsection