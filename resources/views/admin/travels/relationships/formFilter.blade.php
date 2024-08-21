<container>
    <div class="card-header pl-4">
        {{ trans('cruds.travel.fields.patient_filter_title') }}
    </div>
    <div class="row pl-3">
        <div class="col-md-12 pl-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.travel-statuses.index') }}" method="get">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> {{ trans('cruds.travel.fields.patient_code') }} </label>
                                    <input type="text" class="form-control filter" name="patient_code">
                                    <span class="text-danger">
                                        @error('patient_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.patient_name') }}</label>
                                    <input type="text" class="form-control filter" name="patient_name">
                                    <span class="text-danger">
                                        @error('patient_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.gender') }}</label>
                                    <select class="form-control filter" name="gender">
                                        <option value="" selected> </option>
                                        @foreach ($genders as $key => $title)
                                            <option value="{{ $key }}">{{ $title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                                    <input class="form-control filter {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone ?? null) }}">
                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.patient.fields.phone_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.patient_status') }}</label>
                                    <select class="form-control filter" name="status_id">
                                        <option value="" selected></option>
                                        @foreach ($statuses as $key => $status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('status_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">{{ trans('cruds.travel.fields.department') }}</label>
                                    <select class="form-control select2 filter {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                                        <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}></option>
                                        @foreach ($departments as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $travel->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('department') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.department_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row more-filters">

                            <x-province-component class="col-md-4" :data="[]" />

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hospital_id">{{ trans('cruds.travel.fields.shipment_place') }}</label>
                                    <select class="form-control select2 filter {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id">
                                        <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}></option>
                                        @foreach ($hospitals ?? [] as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('hospital_id') ? old('hospital_id') : $travel->hospital->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('hospital'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('hospital') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.hospital_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="office_id">{{ trans('cruds.patient.fields.office') }}</label>
                                    <select class="form-control select2 filter{{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id">
                                        <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}></option>
                                        @foreach ($offices ?? [] as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('office_id') ? old('office_id') : $patient->office->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('office'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('office') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.patient.fields.office_helper') }}</span>
                                </div>
                            </div>


                            <x-reffering-type-component class="col-md-4" :data="[]" />

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="group_id">{{ trans('cruds.travel.fields.group') }}</label>
                                    <select class="form-control filter" name="group_id">
                                        <option value="" selected> </option>
                                        @foreach ($groups as $id => $entry)
                                            <option value="{{ $id }}">{{ $entry }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('group'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('group') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.group_helper') }}</span>
                                </div>
                            </div>

                            <x-campaign-channel-org-component class="col-md-4" :data="[]" />

                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="arrival_date_start">{{ trans('cruds.travel.fields.arrival_date') }}</label>
                                    <input class="form-control date filter {{ $errors->has('arrival_date_start') ? 'is-invalid' : '' }}" type="text" name="arrival_date_start" id="arrival_date_start">
                                    @if ($errors->has('arrival_date_start'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('arrival_date_start') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="arrival_date_end">{{ trans('cruds.travel.fields.arrival_date') }}</label>
                                    <input class="form-control date filter {{ $errors->has('arrival_date_end') ? 'is-invalid' : '' }}" type="text" name="arrival_date_end" id="arrival_date_end">
                                    @if ($errors->has('arrival_date_end'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('arrival_date_end') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.report_arrival_date') }}</label>
                                    <input class="form-control date filter {{ $errors->has('report_arrival_date_start') ? 'is-invalid' : '' }}" type="text" name="report_arrival_date_start" id="report_arrival_date_start">
                                    @if ($errors->has('report_arrival_date_start'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('report_arrival_date_start') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.report_arrival_date') }}</label>
                                    <input class="form-control date filter {{ $errors->has('report_arrival_date_end') ? 'is-invalid' : '' }}" type="text" name="report_arrival_date_end" id="report_arrival_date_end">
                                    @if ($errors->has('report_arrival_date_end'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('report_arrival_date_end') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>

                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.campaign_start_date') }}</label>
                                    <input type="text" class="form-control filter date" name="campaign_start">
                                    <span class="text-danger">
                                        @error('birth_place')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="">{{ trans('cruds.travel.fields.campaign_end') }}</label>
                                    <input type="text" class="form-control filter date" name="campaign_end">
                                    <span class="text-danger">
                                        @error('birth_place')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-8">
                                @can('travel_create')
                                    @if (Auth::user()->roles->first()->id == 100)
                                        <a class="btn btn-success" id="travel-filter-add" href="{{ route('admin.travels.create') }}">
                                            <i class="far fa-plus-square"></i> {{ trans('global.add') }} {{ trans('cruds.travel.title_singular') }}
                                        </a>
                                    @endif
                                    <a class="btn btn-success" href="{{ url('admin/travel') }}">
                                        {{ trans('global.add') }} {{ trans('cruds.travel.title_singular') }}
                                    </a>
                                @endcan
                            </div>
                            <div class="col-4 ">
                                <button class="float-right btn btn-primary ml-3 mt-3 p-2 travel-search" type="button" id="form-filter-submit">
                                    {{ trans('cruds.travel.fields.search') }} <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-info float-right mt-3 p-2" type="button" id="show-filters">
                                    {{ trans('cruds.travel.fields.more_filters') }} <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</container>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showFiltersButton = document.getElementById('show-filters');
        const moreFilters = document.querySelector('.more-filters');
        const formInputs = document.querySelectorAll('.filter');
        const searchButton = document.getElementById('form-filter-submit');

        moreFilters.style.display = 'none';

        showFiltersButton.addEventListener('click', function() {
            if (moreFilters.style.display === 'none') {
                moreFilters.style.display = 'flex';
                showFiltersButton.innerHTML = 'Filtreyi Gizle  <i class="fas fa-filter"></i>';
            } else {
                moreFilters.style.display = 'none';
                showFiltersButton.innerHTML = 'Daha Fazla Filtre <i class="fas fa-filter"></i>';
            }
        });

        formInputs.forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    searchButton.click();
                }
            });
        });
    });
</script>
