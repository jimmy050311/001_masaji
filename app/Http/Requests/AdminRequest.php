<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;


class AdminRequest extends FormRequest
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
            'account' => ['sometimes', 'bail','required',Rule::unique('admins')->ignore($this->id),'regex:/^[A-Za-z0-9]+$/'],
            'password' => ['sometimes','bail','required','regex:/^[A-Za-z0-9]+$/','confirmed'],
            'cellphone' => 'sometimes|bail|required|numeric',
            'email' => 'sometimes|bail|required|string|email',
            'status' => 'sometimes|bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱欄位不可為空',
            'account.required' => '帳號欄位不可為空',
            'account.unique' => '此帳號已存在',
            'account.regex' => '帳號不可含有特殊字符',
            'password.required' => '密碼欄位不可為空',
            'password.regex' => '密碼不可含有特殊字符',
            'password.confirmed' => '密碼輸入不一致',
            'cellphone.required' => '手機欄位不可為空',
            'cellphone.numeric' => '手機欄位格式不正確',
            'email.required' => '信箱欄位不可為空',
            'email.email' => '請輸入正確的信箱格式',
            'status.required' => '狀態欄位不可為空',
            'status.numeric' => '狀態格式錯誤'
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
