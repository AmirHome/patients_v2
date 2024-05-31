<?php

namespace App\Livewire;

use App\Models\ExpensesIncome;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use Livewire\Component;

class FinancialReport extends Component
{
    public $currentYear;
    public $type;

    public $colors = [
        '#ff0000', // January
        '#ff7f00', // February
        '#ffff00', // March
        '#7fff00', // April
        '#00ff00', // May
        '#00ff7f', // June
        '#00ffff', // July
        '#007fff', // August
        '#0000ff', // September
        '#7f00ff', // October
        '#ff00ff', // November
        '#ff007f'  // December
    ];

    public function mount()
    {
        $this->currentYear = Carbon::now()->year;
        $this->type = 'expenses';

    }

    public function render()
    {
        $columnChartModel = $this->generateChart();
        $columnChartModel->setTitle('Expenses by Type')
                            ->setAnimated(true)
                            // ->withOnColumnClickEventName('onColumnClick')
                            // ->setDataLabelsEnabled(true)
                            ->setLegendVisibility(false)
                            ->setOpacity(0.5)
                            ->setColors($this->colors)
                            ->setColumnWidth(30)
                            ->withGrid();

        return view('livewire.financial-report')->with([
            'columnChartModel' => $columnChartModel,
        ]);
    }


    public function generateChart(){
        
        $expensesByMonth = ExpensesIncome::whereYear('created_at', $this->currentYear)
            ->where('category', 1) // Assuming 1 is the category for expenses
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $columnChartModel = new ColumnChartModel();
        $columnChartModel->setTitle('Expenses by Month');

        foreach (range(1, 12) as $month) {
            $monthName = Carbon::create()->month($month)->format('F');
            $amount = $expensesByMonth->get($month, 0);
            $columnChartModel->addColumn($monthName, $amount, '#f6ad55');
        }
        return $columnChartModel;
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
