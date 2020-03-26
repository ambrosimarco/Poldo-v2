<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'online' => 'boolean',
            'debug_mode' => 'boolean',
            'offline_message' => 'string|max:250',
            'order_time_limit' => 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$',
            'retire_time' => 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$',
        ];
    }
}
