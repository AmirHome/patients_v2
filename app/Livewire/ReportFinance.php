<?php

namespace App\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use App\Models\ExpensesIncome;
use Carbon\Carbon;

class ReportFinance extends Component
{
    public $columnChartModel;

    public function mount()
    {
        //$this->generateChart();
        $this->columnChartModel = (new ColumnChartModel())
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4');
    }

/*     public function generateChart()
    {
        $currentYear = Carbon::now()->year;
        $expensesByMonth = ExpensesIncome::whereYear('created_at', $currentYear)
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

        $this->columnChartModel = $columnChartModel;
    }
 */
    public function render()
    {
        return view('livewire.reportfinance');//->with(['columnChartModel'=> $this->columnChartModel]);//->layout('layouts.admin');
    }
}
