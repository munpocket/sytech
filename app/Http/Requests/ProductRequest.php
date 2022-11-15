<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// Hankakuを取り込む
use App\Rules\Hankaku;

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
     * @return array
     */
    public function rules()
    {
        // Hankakuを取り込むには[]表記
        return [
            'productName' => 'required | max:255',
            'companyName' => 'required',
            'price' => ['required', 'max:11', 'alpha_num', new Hankaku],
            'stock' => ['required', 'max:11', 'alpha_num', new Hankaku]
        ];
    }

        /**
 * 項目名
 *
 * @return array
 */
public function attributes()
{
    return [
        'productName' => '商品名',
        'companyName' => '会社名',
        'price' => '価格',
        'stock' => '在庫数',
    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
// それぞれ設定がないとデフォルトで返されるが、設定する
public function messages() {
    return [
        // 例：.required⇒必須項目なのに空欄だった場合、ということ
        'productName.required' => ':attributeは必須項目です。',
        'productName.max' => ':attributeは:max字以内で入力してください。',
        'companyName.required' => ':attributeは必須項目です。',
        'price.required' => ':attributeは必須項目です。',
        'price.max' => ':attributeは:max字以内で入力してください。',
        'price.alpha_num_check' => ':attributeは半角数字で入力してください',
        'stock.required' => ':attributeは必須項目です。',
        'stock.max' => ':attributeは:max字以内で入力してください。',
        'stock.alpha_num_check' => ':attributeは半角数字で入力してください'

    ];
}
}
