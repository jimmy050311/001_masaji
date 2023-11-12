<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class InventoryRequest extends FormRequest
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
            'product_id' => 'sometimes|bail|required|numeric',
            'amount' => 'sometimes|bail|required|numeric',
            'remark' => 'sometimes|bail|required|string',
            'type' => 'sometimes|bail|required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => '商品不可為空',
            'product_id.numeric' => '商品格式不正確',
            'amount.required' => '數量不可為空',
            'amount.numeric' => '數量格式不正確',
            'remark.required' => '備註不可為空',
            'type.required' => '異動類型不可為空',
            'type.numeric' => '異動類型格式不正確',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // 取得錯誤資訊
        $responseData = [
            'success' => 400,
            'message' => $validator->errors()->first()
        ];
        // 產生 JSON 格式的 response，(422 是 Laravel 預設的錯誤 http status，可自行更換) 
        $response = response()->json($responseData, 400);
        // 丟出 exception
        throw new HttpResponseException($response);
    }
}
