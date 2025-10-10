<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'complaint_id' => 'required|exists:complaints,id',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'complaint_id.exists' => 'Keluhan tidak ditemukan',
        ];
    }
}
