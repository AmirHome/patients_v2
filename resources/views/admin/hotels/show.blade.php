@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="hotel-header">
        <h1 class="hotel-name">{{ $hotel->name }}</h1>
        <p class="hotel-location"> {{ $hotel->city->name ?? '' }}, {{ $hotel->country->name ?? '' }}</p>
    </div>

    <div class="hotel-images">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               @foreach($hotel->photos as $key => $media)
               <div class="item active">
                  <img src="{{  $media->getUrl()  }}">
                </div>
               @endforeach
              
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="hotel-details">
        <h2>  {{ trans('cruds.hotel.fields.location') }} {{ $hotel->location }},</h2>
        <p><strong>{{ trans('cruds.hotel.fields.price') }}:</strong> {{ $hotel->price }}</p>
    </div>

    <div class="back-to-list mt-5">
        <a class="btn btn-primary" href="{{ route('admin.hotels.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
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
        color: #676262;
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
    .carousel-inner img {
        max-height: 450px !important;
        min-height: 250px !important;
        background-size: cover;
        width: 100%;
    }
</style>
@endsection