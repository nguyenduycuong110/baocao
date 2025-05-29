<?php

namespace App\Http\Requests\Check\Check;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Check is authorized to make this request.
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
            'department_level' => 'required',
            'branch_level' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('checks', $this->route('id'))
            ],
        ];
    }
}
