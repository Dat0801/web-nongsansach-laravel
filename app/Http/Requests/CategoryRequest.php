<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $category_id = $this->route('category');
        return [
            'category_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category_id, 'category_id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Tên danh mục là bắt buộc.',
            'category_name.unique' => 'Tên danh mục đã tồn tại.',
        ];
    }
}
