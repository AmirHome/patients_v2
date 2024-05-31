<?php

namespace App\Livewire;

use App\Models\ExpensesIncome;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Livewire\Component;

class FinancialReport extends Component
{
    // public $year;
    public $selectedYear;
    public $years;

    public $colors = [
        '#ff0000', '#00ff00', '#0000ff',
        '#FF5733', '#33FF57', '#3357FF', '#F333FF', '#FF3380',
        '#33FFF3', '#FFF333', '#FF8C33', '#9D33FF', '#FF33B5',
    ];

    public function mount()
    {
        //$this->year = Carbon::now()->year; //currentYear
        $this->selectedYear = Carbon::now()->year; //currentYear
        $this->years = ExpensesIncome::whereYear('created_at', '>=', 2020)
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

    }
    public function setYear($year)
    {
        $this->selectedYear = $year;
    }

    public function render()
    {

        $typeCategories = ['expenses' => [1,3], 'commission' => [2,4]];

        $columnChartStackModelExpenses = $this->generateStackChart($typeCategories['expenses'])
                                ->setTitle('Expenses by Type')
                                ->setAnimated(true)
                                // ->setLegendVisibility(false)
                                ->setDataLabelsEnabled(false)
                                ->setOpacity(0.5)
                                ->setColors($this->colors)
                                ->setColumnWidth(30)
                                ->withGrid();

        $columnChartStackModelCommission = $this->generateStackChart($typeCategories['commission'])
                                ->setTitle('Commission by Type')
                                ->setAnimated(true)
                                // ->setLegendVisibility(false)
                                ->setDataLabelsEnabled(false)
                                ->setOpacity(0.5)
                                ->setColors($this->colors)
                                ->setColumnWidth(30)
                                ->withGrid();

        $pieChartModelExpenses = $this->generateByCountry(1);

        $pieChartModelCommission = $this->generateByCountry(2);


        return view('livewire.financial-report', 
        compact('columnChartStackModelExpenses', 'columnChartStackModelCommission', 'pieChartModelExpenses', 'pieChartModelCommission'));
    }

    public function generateStackChart($categories) {

        $expensesData = ExpensesIncome::whereYear('created_at', $this->selectedYear)
        ->where('category', $categories[0])
        ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

        $incomeData = ExpensesIncome::whereYear('created_at', $this->selectedYear)
            ->where('category', $categories[1])
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

    public function generateByCountry($category) {
        $expensesByCountry = ExpensesIncome::whereYear('created_at', $this->selectedYear)
            ->where('category', $category) 
            ->with(['patient.city.country'])
            ->get()
            ->groupBy(function ($expense) {
                return $expense->patient->city->country->name ?? 'Unknown';
            })
            ->map(function ($expenses, $country) {
                return $expenses->sum('amount');
            });

        $pieChartModel = (new PieChartModel())
            ->setTitle('')
            ->setAnimated(true)
            ->setLegendVisibility(true)
            ->setDataLabelsEnabled(true);

        foreach ($expensesByCountry as $country => $total) {
            // $pieChartModel->addSlice($country, $total, $this->colors[$i=($i??0)+1]);

            $label = "$country: \$$total";
            $pieChartModel->addSlice($label, $total, $this->colors[$i=($i??0)+1], ['amount' => $total]);

        }
        return $pieChartModel;
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
