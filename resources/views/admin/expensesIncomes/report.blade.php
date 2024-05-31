@extends('layouts.admin')
@section('content')

@includeIf('admin.expensesIncomes.relationships.formFilter')

<div class="card">
    <div class="card-header">

    </div>

    <div class="card-body">
    



    <livewire:test/>
    </div>
</div>



@endsection
@section('scripts')
@parent

@livewireChartsScripts
<script>



</script>

@endsection