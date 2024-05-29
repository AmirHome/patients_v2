<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\DataTablesFilterTrait;
use App\Http\Requests\MassDestroyExpensesIncomeRequest;
use App\Http\Requests\StoreExpensesIncomeRequest;
use App\Http\Requests\UpdateExpensesIncomeRequest;
use App\Models\Department;
use App\Models\ExpensesIncome;
use App\Models\Patient;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExpensesIncomeController extends Controller
{
    use DataTablesFilterTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->financeMountFilter();

        if ($request->ajax()) {
            // $query = ExpensesIncome::with(['user', 'patient', 'department'])->select(sprintf('%s.*', (new ExpensesIncome)->table));
            $query = ExpensesIncome::with(['user', 'patient', 'department'])
                        ->select('patient_id', 
                            DB::raw('SUM(CASE WHEN category = 1 THEN amount ELSE 0 END) as total_expenses'),
                            DB::raw('SUM(CASE WHEN category = 2 THEN amount ELSE 0 END) as total_expenses_commission'),
                            DB::raw('SUM(CASE WHEN category = 3 THEN amount ELSE 0 END) as total_income'),
                            DB::raw('SUM(CASE WHEN category = 4 THEN amount ELSE 0 END) as total_income_commission'))
                        ->groupBy('patient_id');

            $query = $this->financeFilter($request, $query);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient :  $row->patient->name .' '. $row->patient->surname) : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->patient->city->country ? $row->patient->city?->country?->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'department']);
            // dd($table->toArray());
            return $table->make(true);
        }

        return view('admin.expensesIncomes.index', $data);

    }

    public function create()
    {
        abort_if(Gate::denies('expenses_income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expensesIncomes.create', compact('departments', 'patients', 'users'));
    }

    public function store(StoreExpensesIncomeRequest $request)
    {
        $expensesIncome = ExpensesIncome::create($request->all());

        return redirect()->route('admin.expenses-incomes.index');
    }

    public function edit(ExpensesIncome $expensesIncome)
    {
        abort_if(Gate::denies('expenses_income_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expensesIncome->load('user', 'patient', 'department');

        return view('admin.expensesIncomes.edit', compact('departments', 'expensesIncome', 'patients', 'users'));
    }

    public function update(UpdateExpensesIncomeRequest $request, ExpensesIncome $expensesIncome)
    {
        $expensesIncome->update($request->all());

        return redirect()->route('admin.expenses-incomes.index');
    }

    public function show(ExpensesIncome $expensesIncome)
    {
        abort_if(Gate::denies('expenses_income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expensesIncome->load('user', 'patient', 'department');

        return view('admin.expensesIncomes.show', compact('expensesIncome'));
    }

    public function destroy(ExpensesIncome $expensesIncome)
    {
        abort_if(Gate::denies('expenses_income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expensesIncome->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpensesIncomeRequest $request)
    {
        $expensesIncomes = ExpensesIncome::find(request('ids'));

        foreach ($expensesIncomes as $expensesIncome) {
            $expensesIncome->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
