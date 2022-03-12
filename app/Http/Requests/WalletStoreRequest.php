<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WalletStoreRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'is_enabled' => [
                'required',
                'boolean',
            ],
            'chain_id' => [
                'required',
                Rule::exists('chains', 'id'),
            ],
        ];
    }
}
