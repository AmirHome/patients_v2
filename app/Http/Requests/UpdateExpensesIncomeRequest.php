<?php

namespace App\Http\Requests;

use App\Models\ExpensesIncome;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExpensesIncomeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expenses_income_edit');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'category' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
