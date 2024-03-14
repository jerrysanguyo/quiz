<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'disability_name' => 'required|string|max:255',
        ];
    }
}
