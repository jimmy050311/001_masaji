<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return [
            'name' => 'sometimes|bail|required|string',
            'number' => 'sometimes|bail|required|string',
            'category_id' => 'sometimes|bail|required|numeric',
            'spec' => 'sometimes|bail|required|string',
            'desc' => 'sometimes|bail|required|string',
            'introduction' => 'sometimes|bail|required|string',
            'status' => 'sometimes|bail|required|numeric',
            'type' => 'sometimes|bail|required|numeric',
            'low_amount' => 'sometimes|bail|required|numeric',
            'minute' => 'sometimes|bail|required|numeric',
            'price' => 'sometimes|bail|required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '產品名稱不可為空',
            'number.required' => '產品編號不可為空',
            'category_id.required' => '產品類別不可為空',
            'category_id.numeric' => '產品類別格式不正確',
            'spec.required' => '規格不可為空',
            'desc.required' => '描述不可為空',
            'introduction.required' => '商品介紹不可為空',
            'status.required' => '狀態不可為空',
            'status.numeric' => '狀態格式不正確',
            'type.required' => '商品類型不可為空',
            'type.numeric' => '商品類型格式不正確',
            'low_amount.required' => '庫存低水位警示不可為空',
            'low_amount.numeric' => '庫存低水位警示格式不正確',
            'minute.required' => '時間(分鐘)不可為空',
            'minute.numeric' => '時間(分鐘)格式不正確',
            'price.required' => '原價格不可為空',
            'price.numeric' => '原價格格式不正確',
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
