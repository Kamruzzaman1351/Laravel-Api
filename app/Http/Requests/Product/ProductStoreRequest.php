<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;



class ProductStoreRequest extends FormRequest
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
        return [
            'name'=> 'required | min:5', 
            'description' => 'required | min:10', 
            'price' => 'required ', 
            'sku' => 'required', 
            'is_active' => 'required', 
            'quantity' => 'required', 
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $responseBuild =  response()->json([
            'message' => 'Validation failed, request can\'t be processed!',
            'status' => false,
            'errors' => $validator->errors()
        ], 422);

        throw new ValidationException($validator, $responseBuild);
    }

    public function messages() {
        return [
            'name.required' => 'Product Name is Required',
            'description.required' => 'Product Description is required',
            'price.required' => 'Product Price is Required',
            'sku.required' => 'Product SKU Code is Required',
            'is_active' => 'Product available is Required',
            'quantity.required' => 'Product quantity is Required',
        ];
    }
}
