<div>
    <input type="button" value="commission" wire:model="type"/>
    <livewire:livewire-column-chart
        key="{{ $columnChartModel->reactiveKey() }}"
        :column-chart-model="$columnChartModel"
    />
</div>
