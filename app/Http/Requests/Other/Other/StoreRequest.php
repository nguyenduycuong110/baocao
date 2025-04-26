<?php

namespace App\Http\Requests\Other\Other;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Other is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'admin_guidelines' => 'required',
            'business_info' => 'required',
            'issue_solving' => 'required',
            'regulation_proposal' => 'required',
        ];
    }
}
