<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class CouponRequest extends FormRequest
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
            'category_id' => 'sometimes|bail|required|numeric',
            'discount' => 'sometimes|bail|required|numeric',
            'desc' => 'sometimes|bail|required|string',
            'status' => 'sometimes|bail|required|numeric',
            'code' => 'sometimes|bail|required|string',
            'start_date' => 'sometimes|bail|required',
            'end_date' => 'sometimes|bail|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱不可為空',
            'category_id.required' => 'sometimes|bail|required|numeric',
            'category_id.numeric' => '類別格式不正確',
            'discount.required' => 'sometimes|bail|required|numeric',
            'discount.numeric' => '折扣格式不正確',
            'desc.required' => '簡述不可為空',
            'code.required' => '優惠碼不可為空',
            'status.required' => '狀態不可為空',
            'status.numeric' => '狀態格式不正確',
            'start_date.required' => '開始時間不可為空',
            'end_date.required' => '結束時間不可為空',
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
