<?php

namespace App\Http\Requests\Violation\Violation;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;


class UpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

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
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('violations', $this->id)
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('violation')
        ]);
    }

}
