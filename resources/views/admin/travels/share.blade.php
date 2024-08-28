@extends('layouts.mail')
@section('content')

    <div class="header">
        <img src="{{ asset('img/clinic-template-logo.png') }}" alt="logo" class="main-logo">
    </div>

<div class="container">
  @includeIf('admin.travels.relationships.travelTravelTreatmentActivities', ['travelTreatmentActivities' => $travel->travelTravelTreatmentActivities])
</div>

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const downIcons = document.querySelectorAll('.fa-chevron-down');
            const rightIcons = document.querySelectorAll('.test');
            const tables = document.querySelectorAll('.table-custom');

            downIcons.forEach((icon, index) => {
                const table = tables[index];
                const rightIcon = rightIcons[index];
                // Initial state setup
                table.style.display = 'table';
                icon.style.display = 'inline';
                rightIcon.style.display = 'none';

                icon.addEventListener('click', () => {
                    table.style.display = 'none';
                    icon.style.display = 'none';
                    rightIcon.style.display = 'inline';
                });

                rightIcon.addEventListener('click', () => {
                    table.style.display = 'table';
                    rightIcon.style.display = 'none';
                    icon.style.display = 'inline';
                });
            });
        });
    </script>
@endsection
