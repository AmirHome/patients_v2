@extends('layouts.admin')
@section('content')


<livewire:financial-report/>


@endsection
@section('scripts')
@parent

@livewireChartsScripts

@endsection