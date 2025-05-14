<?php

namespace App\Http\Requests\Violation\Violation;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Violation is authorized to make this request.
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
            'smuggling_cases' => 'required',
            'smuggling_value' => 'required',
            'drug_cases' => 'required',
            'drug_pills' => 'required',
            'ip_cases' => 'required',
            'ip_value' => 'required',
            'admin_cases' => 'required',
            'admin_value' => 'required',
            'other_cases' => 'required',
            'other_value' => 'required',
        ];
    }
}
