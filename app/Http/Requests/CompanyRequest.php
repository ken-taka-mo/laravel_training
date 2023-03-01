<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function rules() {
        if ($this->has('get_address')) {
            return ['postal_code' => 'required|regex:/^\d{7}$/'];
        }
        return [
            'name' => 'required|max:64',
            'manager_name' => 'required|max:32',
            'phone_number' => 'required|regex:/^\d{1,11}$/',
            'postal_code' => 'required|regex:/^\d{7}$/',
            'prefecture_code' => 'required|numeric|min:1|max:47',
            'address'=> 'required|max:100',
            'mail_address' => 'required|max:100|regex:/^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*$/',
            'prefix' => \Route::uses('store') ? 'required|regex:/^[a-zA-Z0-9]{1,8}$/' : 'filled',
        ];
    }

    public function messages() {
        return [
            'phone_number.regex' => ':attributeは半角数字で入力してください',
            'postal_code.regex' => '正しい:attributeを入力してください',
            'mail_address.regex' => '正しい:attributeを入力してください',
            'prefix.regex' => ':attributeは半角英数字で入力してください'
        ];
    }

    public function attributes() {
        return [
            'name' => '会社名', 'manager_name' => '担当者名', 'phone_number' => '電話番号',
            'postal_code' => '郵便番号', 'prefecture_code' => '都道府県', 'address' => '住所',
            'mail_address' => 'メールアドレス', 'prefix' => 'プレフィックス'
        ];
    }

    public function updateAttributes() {
        return $this->only(
            [
                'name',
                'manager_name',
                'phone_number',
                'postal_code',
                'prefecture_code',
                'address',
                'mail_address',
            ]
        );
    }
}
