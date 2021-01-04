<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithDrawRequest extends FormRequest
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
        return [
            'method'=>'required|min:5',
            'amount' => 'required|numeric',
            'email' => 'required|email',
            'account_no' => 'required|numeric',
            'account_name' => 'required|string',
            'account_address' => 'required|string',
            'reference' => 'min:5'
        ];
    }
}
