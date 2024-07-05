<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
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
        $product_id = $this->route('product_id');        
        return [
            //
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($product_id, 'product_id'),
            ],
            'product_price' => 'required|numeric|min:0.01',
            'product_quantity' => 'required|integer|min:1',
            'product_stock' => 'required|integer:min:0'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại.',
            'product_price.required' => 'Giá sản phẩm là bắt buộc.',
            'product_price.numeric' => 'Giá sản phẩm phải là số.',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn 0.',
            'product_quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'product_quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'product_quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0.',
            'product_stock.required' => 'Số lượng tồn kho là bắt buộc.',
            'product_stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'product_stock.min' => 'Số lượng tồn kho phải lớn hơn 0.'
            
        ];
    }
}
