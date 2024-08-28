@extends('layouts.share')
@section('content')

    <div class="header">
        <img src="{{ asset('img/clinic-template-logo.png') }}" alt="logo" class="main-logo">
    </div>
    
    @if (session('success'))
    <div class="container">
        <div class="card-header d-flex justify-content-center align-items-center">
            <div>Kayıt Başarıyla Tamamlandı.</div>
        </div>
    </div>
    @else
    <div class="container">
        @if(request()->is("share/translator") || request()->is("share/translator/*"))
        <div class="card-header d-flex justify-content-between align-items-center">
            <div></div>
            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add-travel-treatment-activities">
                {{ trans('global.add') }}
            </button>
        </div>
        @includeIf('admin.travels.relationships.modalAddTreatmentActivities')
        @endif
        @includeIf('admin.travels.relationships.travelTravelTreatmentActivities', ['travelTreatmentActivities' => $travel->travelTravelTreatmentActivities])
    </div>
    @endif
@endsection

@section('scripts')
    @parent
    <script>
      
    </script>
@endsection
