<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeightRequest extends FormRequest
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
        $weight_id = $this->route('weight');
        return [
            'weight_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('weights')->ignore($weight_id, 'weight_id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'weight_name.required' => 'Tên đơn vị trọng lượng là bắt buộc.',
            'weight_name.unique' => 'Tên đơn vị trọng lượng đã tồn tại.',
        ];
    }
}
