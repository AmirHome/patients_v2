@extends('layouts.admin')
@section('content')

@includeIf('admin.expensesIncomes.relationships.formFilter')

<div class="card">
    <div class="card-header">

    </div>

    <div class="card-body">

    <livewire:financial-report/>
    </div>
</div>

@endsection
@section('scripts')
@parent

@livewireChartsScripts

@endsection