<div>
    <div class="btn-group" role="group" aria-label="Year Buttons">
        @foreach($years as $year)
            <button class="btn {{ $year == $selectedYear ? 'btn-info' : 'btn-secondary' }}" wire:click="setYear({{ $year }})">{{ $year }}</button>
        @endforeach

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Expenses of @json($selectedYear)</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartStackModelExpenses->reactiveKey() }}"
                        :column-chart-model="$columnChartStackModelExpenses"
                    />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Commisson of @json($selectedYear)</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartStackModelCommission->reactiveKey() }}"
                        :column-chart-model="$columnChartStackModelCommission"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Expenses by Country of @json($selectedYear)</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-pie-chart :pie-chart-model="$pieChartModelExpenses" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Commisson of @json($selectedYear)</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-pie-chart :pie-chart-model="$pieChartModelCommission" />

                </div>
            </div>
        </div>
    </div>
</div>
