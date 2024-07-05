<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitRequest extends FormRequest
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
        $unit_id = $this->route('unit');
        return [
            'unit_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units')->ignore($unit_id, 'unit_id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'unit_name.required' => 'Tên đơn vị là bắt buộc.',
            'unit_name.unique' => 'Tên đơn vị đã tồn tại.',
        ];
    }
}
