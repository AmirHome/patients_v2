<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpensesIncomeRequest;
use App\Http\Requests\UpdateExpensesIncomeRequest;
use App\Http\Resources\Admin\ExpensesIncomeResource;
use App\Models\ExpensesIncome;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpensesIncomeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expenses_income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpensesIncomeResource(ExpensesIncome::with(['user', 'patient', 'department'])->get());
    }

    public function store(StoreExpensesIncomeRequest $request)
    {
        $expensesIncome = ExpensesIncome::create($request->all());

        return (new ExpensesIncomeResource($expensesIncome))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExpensesIncome $expensesIncome)
    {
        abort_if(Gate::denies('expenses_income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpensesIncomeResource($expensesIncome->load(['user', 'patient', 'department']));
    }

    public function update(UpdateExpensesIncomeRequest $request, ExpensesIncome $expensesIncome)
    {
        $expensesIncome->update($request->all());

        return (new ExpensesIncomeResource($expensesIncome))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExpensesIncome $expensesIncome)
    {
        abort_if(Gate::denies('expenses_income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expensesIncome->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
