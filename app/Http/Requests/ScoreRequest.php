<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_scoreId' => 'required|exists:users,id',
            'score' => 'required|numeric',
            'examType' => 'required|string',
        ];
    }
}
