@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="hotel-header">
        <h1 class="hotel-name">{{ $hotel->name }}</h1>
        <p class="hotel-location">{{ $hotel->location }}, {{ $hotel->city->name ?? '' }}, {{ $hotel->country->name ?? '' }}</p>
    </div>

    <div class="hotel-images">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($imgs??[]  as $id => $img)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ asset('path/to/images/'.$img) }}" alt="Image {{ $id }}">
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
        <h2>  {{ trans('cruds.hotel.fields.location') }}</h2>
        <p><strong>{{ trans('cruds.hotel.fields.price') }}:</strong> {{ $hotel->price }}</p>
    </div>

    <div class="back-to-list">
        <a class="btn btn-primary" href="{{ route('admin.hotels.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
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
        <tr>
            <th>
                {{ trans('cruds.hotel.fields.photos') }}
            </th>
            <td>
                @foreach($hotel->photos as $key => $media)
                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $media->getUrl('thumb') }}">
                    </a>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>


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
        margin-top: 30px;
    }
</style>
@endsection