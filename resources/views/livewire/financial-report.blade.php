<div>
    <div class="btn-group" role="group" aria-label="Category Buttons">
{{--         <button class="btn  {{ $type == 'expenses' ? 'btn-info' : 'btn-secondary' }}" wire:click="setType('expenses')">Expenses Income</button>
        <button class="btn  {{ $type == 'commission' ? 'btn-info' : 'btn-secondary' }}" wire:click="setType('commission')">Commission</button> --}}
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Report Expenses of @json($year)</h4>
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
                    <h4>Report Commisson of @json($year)</h4>
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
</div>
