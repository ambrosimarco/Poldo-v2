<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SandwichRequest extends FormRequest
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
            'name' => 'required|max:100',
            'price' => 'required|between:0,99.99',
            'description' => 'required|max:255',
            'type' => 'required|in:Caldo,Freddo'
        ];
    }
}
