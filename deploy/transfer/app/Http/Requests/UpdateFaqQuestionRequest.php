<?php

namespace App\Http\Requests;

use App\Models\FaqQuestion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFaqQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('faq_question_edit');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'question' => [
                'required',
            ],
            'answer' => [
                'required',
            ],
        ];
    }
}