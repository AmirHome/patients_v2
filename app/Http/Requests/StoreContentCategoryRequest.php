<?php

namespace App\Http\Requests;

use App\Models\ContentCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContentCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_category_create');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
                'slug' => \Str::slug($this->name),
            ]);
        }

    
public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
