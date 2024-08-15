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
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExpensesIncomeController extends Controller
{
    use DataTablesFilterTrait;

    public function index(Request $request, $type = null)
    {
        //dd($request->all());
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ($type === 'commission') ? [2, 4] : [1, 3];
        $data = $this->financeMountFilter();

        // dd($categories);
        if ($request->ajax()) {
            
            $query = ExpensesIncome::with(['patient'])
                ->select(
                    'patient_id',
                    
                    DB::raw('SUM(CASE WHEN category = ' . $categories[0] . ' THEN amount ELSE 0 END) as total_expenses'),
                    DB::raw('SUM(CASE WHEN category = ' . $categories[1] . ' THEN amount ELSE 0 END) as total_income')

                )
                ->groupBy('patient_id');
                
            $query = $this->financeFilter($request, $query);

            $expensesTotalQuery = ExpensesIncome::where('category', $categories[0]);
            $incomesTotalQuery = ExpensesIncome::where('category', $categories[1]);
            $expensesTotalQuery = $this->financeFilter($request, $expensesTotalQuery);
            $incomesTotalQuery = $this->financeFilter($request, $incomesTotalQuery);

            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-xs btn-primary" href="' . route('admin.expenses-incomes.patient.index', $row->patient_id) . '">' .
                    trans('global.view') .
                    '</a>';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient :  $row->patient->name . ' ' . $row->patient->surname) : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->patient->city->country ? $row->patient->city?->country?->name : '';
            });

            $table->editColumn('total_expenses', function ($row) {
                return number_format($row->total_expenses, 2);
            });
            $table->editColumn('total_income', function ($row) {
                return number_format($row->total_income, 2);
            });
            $table->addColumn('total_difference', function ($row) {
                $total_expenses = $row->total_expenses;
                $total_income = $row->total_income;
                return number_format($total_income - $total_expenses, 2);
            });

            $table->rawColumns([ 'actions', 'placeholder', 'patient', 'department']);

            $expensesTotal = $expensesTotalQuery->sum('amount');
            $incomesTotal = $incomesTotalQuery->sum('amount');
            $profit = $incomesTotal - $expensesTotal;
        
            return $table->with('expensesTotal', number_format($expensesTotal, 2))
                         ->with('incomesTotal', number_format($incomesTotal, 2))
                         ->with('profit', number_format($profit, 2))
                         ->make(true);       
        }


        return view('admin.expensesIncomes.index', $data)->with('type', $type);
    }

    public function commission(Request $request)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->financeMountFilter();

        if ($request->ajax()) {
            $query = ExpensesIncome::with(['patient'])
                ->select(
                    'patient_id',
                    // DB::raw('SUM(CASE WHEN category = 1 THEN amount ELSE 0 END) as total_expenses'),
                    DB::raw('SUM(CASE WHEN category = 2 THEN amount ELSE 0 END) as total_expenses_commission'),
                    // DB::raw('SUM(CASE WHEN category = 3 THEN amount ELSE 0 END) as total_income'),
                    DB::raw('SUM(CASE WHEN category = 4 THEN amount ELSE 0 END) as total_income_commission')
                )
                ->groupBy('patient_id');

            $query = $this->financeFilter($request, $query);

            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-xs btn-primary" href="' . route('admin.expenses-incomes.patient.index', $row->patient_id) . '">' .
                    trans('global.view') .
                    '</a>';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient :  $row->patient->name . ' ' . $row->patient->surname) : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->patient->city->country ? $row->patient->city?->country?->name : '';
            });

            $table->addColumn('total_difference', function ($row) {
                $total_expenses = $row->total_expenses_commission;
                $total_income = $row->total_income_commission;
                return $total_income - $total_expenses;
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'department']);


            return $table->make(true);
        }

        return view('admin.expensesIncomes.indexCommission', $data);
    }

    public function report(Request $request)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->financeMountFilter();

        

        /*

            <livewire:livewire-column-chart
                key="{{ $columnChartModel->reactiveKey() }}"
                :column-chart-model="$columnChartModel"
            />

            @livewireChartsScripts

            $columnChartModel = (new ColumnChartModel())
                ->setTitle('Expenses by Type')
                ->addColumn('Food', 100, '#f6ad55')
                ->addColumn('Shopping', 200, '#fc8181')
                ->addColumn('Travel', 300, '#90cdf4');

            $pieChartModel = (new PieChartModel())
                ->setTitle('Expenses by Type')
                ->addSlice('Food', 100, '#f6ad55')
                ->addSlice('Shopping', 200, '#fc8181')
                ->addSlice('Travel', 300, '#90cdf4'); 
                    
                    
            */

        return view('admin.expensesIncomes.report', $data);

    }

    public function reportCommission(Request $request)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->financeMountFilter();

        if ($request->ajax()) {
            $query = ExpensesIncome::with(['patient'])
                ->select(
                    'patient_id',
                    // DB::raw('SUM(CASE WHEN category = 1 THEN amount ELSE 0 END) as total_expenses'),
                    DB::raw('SUM(CASE WHEN category = 2 THEN amount ELSE 0 END) as total_expenses_commission'),
                    // DB::raw('SUM(CASE WHEN category = 3 THEN amount ELSE 0 END) as total_income'),
                    DB::raw('SUM(CASE WHEN category = 4 THEN amount ELSE 0 END) as total_income_commission')
                )
                ->groupBy('patient_id');

            $query = $this->financeFilter($request, $query);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-xs btn-primary" href="' . route('admin.expenses-incomes.patient.index', $row->patient_id) . '">' .
                    trans('global.view') .
                    '</a>';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient :  $row->patient->name . ' ' . $row->patient->surname) : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->patient->city->country ? $row->patient->city?->country?->name : '';
            });

            $table->addColumn('total_difference', function ($row) {
                $total_expenses = $row->total_expenses_commission;
                $total_income = $row->total_income_commission;
                return $total_income - $total_expenses;
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'department']);


            return $table->make(true);
        }

        /*         
        @livewireChartsScripts
        <livewire:scripts /> 
        */
        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4');

        $pieChartModel = (new PieChartModel())
            ->setTitle('Expenses by Type')
            ->addSlice('Food', 100, '#f6ad55')
            ->addSlice('Shopping', 200, '#fc8181')
            ->addSlice('Travel', 300, '#90cdf4');

        return view('admin.expensesIncomes.reportCommission', $data)
            ->with('pieChartModel', $pieChartModel)
            ->with('columnChartModel', $columnChartModel);
    }

    public function indexPatient(Request $request, $patientId)
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->financeMountFilter();

        // append patient id to data
        $data['patient'] = Patient::find($patientId);

        if ($request->ajax()) {

            $query = ExpensesIncome::with(['user', 'patient', 'department'])->select(sprintf('%s.*', (new ExpensesIncome)->table))
                ->where('patient_id', $patientId);

            $query = $this->financeFilter($request, $query);

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

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient :  $row->patient->name . ' ' . $row->patient->surname) : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->patient->city->country ? $row->patient->city?->country?->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'department']);
            // dd($table->toArray());
            return $table->make(true);
        }

        return view('admin.expensesIncomes.indexPatient', $data)->with('patientId', $patientId);
    }

    public function create()
    {
        abort_if(Gate::denies('expenses_income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expensesIncomes.create', compact('departments', 'patients'));
    }

    public function store(StoreExpensesIncomeRequest $request)
    {
        $expensesIncome = ExpensesIncome::create($request->all());

        $type = ($expensesIncome->category == 2 || $expensesIncome->category == 4) ? 'commission' : 'financial';
        return redirect()->route('admin.expenses-incomes.index', $type);
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

        $type = ($expensesIncome->category == 2 || $expensesIncome->category == 4) ? 'commission' : 'financial';
        return redirect()->route('admin.expenses-incomes.index', $type);
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
