<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncomeCategoryRequest;
use App\Http\Requests\StoreIncomeCategoryRequest;
use App\Http\Requests\UpdateIncomeCategoryRequest;
use App\Models\IncomeCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('income_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeCategories = IncomeCategory::all();

        return view('admin.incomeCategories.index', compact('incomeCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incomeCategories.create');
    }

    public function store(StoreIncomeCategoryRequest $request)
    {
        $incomeCategory = IncomeCategory::create($request->all());

        return redirect()->route('admin.income-categories.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(IncomeCategory $incomeCategory)
    {
        abort_if(Gate::denies('income_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incomeCategories.edit', compact('incomeCategory'));
    }

    public function update(UpdateIncomeCategoryRequest $request, IncomeCategory $incomeCategory)
    {
        $incomeCategory->update($request->all());

        return redirect()->route('admin.income-categories.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(IncomeCategory $incomeCategory)
    {
        abort_if(Gate::denies('income_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incomeCategories.show', compact('incomeCategory'));
    }

    public function destroy(IncomeCategory $incomeCategory)
    {
        abort_if(Gate::denies('income_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncomeCategoryRequest $request)
    {
        $incomeCategories = IncomeCategory::find(request('ids'));

        foreach ($incomeCategories as $incomeCategory) {
            $incomeCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
