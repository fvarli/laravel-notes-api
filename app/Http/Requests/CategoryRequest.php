<?php

namespace App\Http\Requests;

class CategoryRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories,name|max:255',
        ];
    }
}
