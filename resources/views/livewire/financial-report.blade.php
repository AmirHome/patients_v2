<div>
    <div class="btn-group" role="group" aria-label="Category Buttons">
        <button class="btn  {{ $type == 'expenses' ? 'btn-info' : 'btn-secondary' }}" wire:click="setType('expenses')">Expenses Income</button>
        <button class="btn  {{ $type == 'commission' ? 'btn-info' : 'btn-secondary' }}" wire:click="setType('commission')">Commission</button>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Income</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartModel[0]->reactiveKey() }}"
                        :column-chart-model="$columnChartModel[0]"
                    />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Expenses</h4>
                </div>
                <div class="card-body" style="height: 24rem;">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartModel[1]->reactiveKey() }}"
                        :column-chart-model="$columnChartModel[1]"
                    />
                </div>
            </div>
        </div>
    </div>

</div>
