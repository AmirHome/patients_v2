<?php

namespace App\Http\Controllers\Admin\Override;

use App\Http\Controllers\Admin\ExpenseReportController as ParentController;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Patient;
use Carbon\Carbon;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;


class ExpenseReportController extends ParentController
{
    public function index()
    {
        $patients = Patient::pluck('code', 'id');

        $y = request()->y;
        $m = request()->m;
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            $y ?? Carbon::now()->year,
            $m ?? Carbon::now()->month
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $patientId = request()->patient_id??$patients->first();

        $expenses = Expense::with('expense_category')
            ->whereBetween('entry_date', [$from, $to])
            ->when($patientId, function ($query) use ($patientId) {
                return $query->where('patient_id', $patientId);
            });

        $incomes = Income::with('income_category')
            ->whereBetween('entry_date', [$from, $to])
            ->when($patientId, function ($query) use ($patientId) {
                return $query->where('patient_id', $patientId);
            });

        $expensesTotal   = $expenses->sum('amount');
        $incomesTotal    = $incomes->sum('amount');
        $groupedExpenses = $expenses->whereNotNull('expense_category_id')->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $groupedIncomes  = $incomes->whereNotNull('income_category_id')->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit          = $incomesTotal - $expensesTotal;

        $expensesSummary = [];
        foreach ($groupedExpenses as $exp) {
            foreach ($exp as $line) {
                if (! isset($expensesSummary[$line->expense_category->name])) {
                    $expensesSummary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }
                $expensesSummary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $incomesSummary = [];
        foreach ($groupedIncomes as $inc) {
            foreach ($inc as $line) {
                if (! isset($incomesSummary[$line->income_category->name])) {
                    $incomesSummary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $incomesSummary[$line->income_category->name]['amount'] += $line->amount;
            }
        }

        return view('admin.expenseReports.index', compact(
            'expensesSummary',
            'incomesSummary',
            'expensesTotal',
            'incomesTotal',
            'profit',
            'patients',
            'patientId',
            'y','m'
        ));
    }

    public function filter(Request $request)
    {
        dd($request->all());
    }
}
