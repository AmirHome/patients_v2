<?php

namespace App\Livewire;

use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;

class Test extends Component
{

    public function render()
    {
        $columnChartModel = $this->generateFakeChart();
        // $this->generateChart();

        return view('livewire.test')->with([
            'columnChartModel' => $columnChartModel,
        ]);
    }


    public function generateChart(){

    }


    public function generateFakeChart()
    {
        $expenses = collect([
            ['type' => 'food', 'amount' => 200],
            ['type' => 'food', 'amount' => 1200],
            ['type' => 'shopping', 'amount' => 1000],
            ['type' => 'entertainment', 'amount' => 200],
            ['type' => 'travel', 'amount' => 500],
        ]);
        $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

        $firstRun = true;
        $showDataLabels = false;
        $colors = [
            'food' => '#0e5a92',
            'shopping' => '#ffd77f',
            'entertainment' => '#337043',
            'travel' => '#ff5d01',
            'other' => '#cbd5e0',
        ];

        $columnChartModel = $expenses->groupBy('type')
            ->reduce(function ($columnChartModel, $data) use ($colors){
                // dd($data->sum('amount'));
                $type = $data->first()['type'];
                $value = $data->sum('amount');
                // $type = $data->first()->type;
                // $value = $data->sum('amount');

                return $columnChartModel->addColumn($type, $value, $colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Expenses by Type')
                ->setAnimated($firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($showDataLabels)
                // ->setOpacity(0.125)
                // ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
                ->withGrid()
            );

            $firstRun = false;

            return $columnChartModel;
    }
}
