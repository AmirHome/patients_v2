<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpensesIncomeRequest;
use App\Http\Requests\StoreExpensesIncomeRequest;
use App\Http\Requests\UpdateExpensesIncomeRequest;
use App\Models\Department;
use App\Models\ExpensesIncome;
use App\Models\Patient;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExpensesIncomeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ExpensesIncome::with(['user', 'patient', 'department'])->select(sprintf('%s.*', (new ExpensesIncome)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'expenses_income_show';
                $editGate      = 'expenses_income_edit';
                $deleteGate    = 'expenses_income_delete';
                $crudRoutePart = 'expenses-incomes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? ExpensesIncome::CATEGORY_SELECT[$row->category] : '';
            });
            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->name : '';
            });

            $table->editColumn('patient.surname', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->surname) : '';
            });
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'department']);

            return $table->make(true);
        }

        return view('admin.expensesIncomes.index');
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
