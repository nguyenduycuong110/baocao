<?php

namespace App\Http\Requests\Tax\Tax;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the Tax is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * Rule::unique('users')->ignore($this->route('user'))
     */

   
    public function rules(): array
    {
        return [
            'vat_tax' => 'required',
            'export_import_tax' => 'required',
            'income_tax' => 'required',
            'personal_income_tax' => 'required',
            'other_revenue' => 'required',
            'refunded_tax_declaration' => 'required',
            'refunded_tax_amount' => 'required',
            'current_debt' => 'required',
            'overdue_debt' => 'required',
            'tax_collection_declaration' => 'required',
            'tax_amount' => 'required',
            'business' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('taxes', $this->route('tax'))
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('tax')
        ]);
    }

}
