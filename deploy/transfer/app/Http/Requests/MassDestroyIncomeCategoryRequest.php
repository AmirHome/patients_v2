<?php

namespace App\Http\Requests;

use App\Models\IncomeCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIncomeCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('income_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:income_categories,id',
        ];
    }
}
