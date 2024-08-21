@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dashboard.title') }}
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white">
                                <div class="card-body pb-2">
                                    <div class="text-header">{{ $settings1['chart_title'] }}</div>
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white">
                                <div class="card-body pb-2">
                                    <div class="text-header">{{ $settings2['chart_title'] }}</div>
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white">
                                <div class="card-body pb-2">
                                    <div class="text-header">{{ $settings3['chart_title'] }}</div>
                                    <div class="text-value">{{ number_format($settings3['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="card text-white">
                                <div class="card-body pb-2">
                                    <div class="text-header">{{ $settings4['chart_title'] }}</div>
                                    <div class="text-value">{{ number_format($settings4['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mt-5 dashboarCalendars">
            <div class="card-header">
                {{ trans('cruds.tasksCalendar.title') }}
            </div>
            <div class="card-body">
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />  
                <div id="calendar"></div>
            </div>
        </div> 
    </div>

@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                @foreach($events as $event)
                @if($event->due_date)
                    {
                        title: '{{ $event->name }}',
                        start: '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                        url: '{{ url('admin/tasks').'/'.$event->id.'/edit' }}'
                    },
                @endif
                @endforeach
            ]
        });
    });
</script>
@endsection
