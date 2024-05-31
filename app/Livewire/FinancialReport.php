<?php

namespace App\Livewire;

use App\Models\ExpensesIncome;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use Livewire\Component;

class FinancialReport extends Component
{
    public $year;

    public $colors = ['#ff0000', '#00ff00', '#0000ff']; //Red for Expenses, Green for Paid (Income), Blue for Remind

    public function mount()
    {
        $this->year = Carbon::now()->year; //currentYear

    }

    public function render()
    {

        $typeCategories = ['expenses' => [1,3], 'commission' => [2,4]];

        $columnChartStackModelExpenses = $this->generateStackChart($typeCategories['expenses'])->setTitle('Expenses by Type')
                                ->setAnimated(true)
                                // ->setLegendVisibility(false)
                                ->setDataLabelsEnabled(false)
                                ->setOpacity(0.5)
                                ->setColors($this->colors)
                                ->setColumnWidth(30)
                                ->withGrid();

        $columnChartStackModelCommission = $this->generateStackChart($typeCategories['commission'])->setTitle('Commission by Type')
                                ->setAnimated(true)
                                // ->setLegendVisibility(false)
                                ->setDataLabelsEnabled(false)
                                ->setOpacity(0.5)
                                ->setColors($this->colors)
                                ->setColumnWidth(30)
                                ->withGrid();


        return view('livewire.financial-report', compact('columnChartStackModelExpenses', 'columnChartStackModelCommission'));
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function generateStackChart($categories) {

        $expensesData = ExpensesIncome::whereYear('created_at', $this->year)
        ->where('category', 1)
        ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

        $incomeData = ExpensesIncome::whereYear('created_at', $this->year)
            ->where('category', 3)
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Expenses and Income by Month')
            ->setDataLabelsEnabled(true)
            ->multiColumn() // Set chart to display multiple column series
            ->stacked(true); // Set chart to display column series stacked


            foreach (range(1, 12) as $month) {
                $monthName = Carbon::create()->month($month)->format('F');

                $expenses = $expensesData->get($month, 0);
                $income = $incomeData->get($month, 0);
                $remind = $expenses - $income;
    
                $columnChartModel->addSeriesColumn('Expenses', $monthName, $expenses, ['#ff0000']);
                $columnChartModel->addSeriesColumn('Paid', $monthName, $income, ['#00ff00']);
                $columnChartModel->addSeriesColumn('Remind', $monthName, $remind, ['#0000ff']);
            }

        return $columnChartModel;
    }
    
    public function generateChart($category){
        
        $expensesByMonth = ExpensesIncome::whereYear('created_at', $this->currentYear)
            ->where('category', $category) // Assuming 1 is the category for expenses
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
