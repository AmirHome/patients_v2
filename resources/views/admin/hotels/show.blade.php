@extends('layouts.admin')
@section('content')

<div class="container">
  <div class="card-header d-flex justify-content-end align-items-end">
    <div class="form-group mb-0">
        <a class="btn btn-default" href="{{ route('admin.hotels.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>

    <div class="hotel-header">
        <h1 class="hotel-name">{{ $hotel->name }}</h1>
        <p class="hotel-location">{{ $hotel->city->name ?? '' }}, {{ $hotel->country->name ?? '' }}</p>
    </div>
    <div id="hotelCarousel" class="carousel slide hotel-images" data-ride="carousel">
         <div class="carousel-inner">
           @forelse($hotel->photos as $key => $media)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $media->getUrl() }}" class="d-block w-100" alt="Hotel Image {{ $key + 1 }}">
                </div>
            @empty
                <div class="carousel-item active">
                   <div class="d-block w-100 no-image-placeholder">
                     <img src="{{ asset('img/img-not-found.png') }}" class="d-block w-100" alt="Hotel Image">
                   </div>
                </div>
            @endforelse
        </div>
        <a class="carousel-control-prev" href="#hotelCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#hotelCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="hotel-details">
        <h2 class="pt-2">{{ trans('cruds.hotel.fields.location') }} {{ $hotel->location }},</h2>
        <p class="pt-3"><strong>{{ trans('cruds.hotel.fields.price') }}:</strong> {{ $hotel->price }} €</p>
    </div>

</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .hotel-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .hotel-name {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .hotel-location {
        font-size: 1.2rem;
        color: #646161;
    }

    .hotel-images {
        margin-bottom: 20px;
    }

    .hotel-details {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .back-to-list {
        text-align: center;
    }

    .carousel-inner {
        min-height: 400px;
        width: 100%; 
    }

    .carousel-inner img, .no-image-placeholder {
        height: 400px;
        object-fit: contain;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-image: none !important;
    }
  .carousel-control-prev::before {
        content: '◁';
        color: #646161;
        font-size: 1rem;
    }

    .carousel-control-next::before {
        content: '▷';
        color: #646161;
        font-size: 1rem;
    }

</style>
@endsection
