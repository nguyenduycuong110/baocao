<?php

namespace App\Http\Requests\Unit\Unit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the Unit is authorized to make this request.
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
            'total_unit_personnel' => 'required',
            'present_personnel' => 'required',
            'present_cbcc' => 'required',
            'leadership_duty' => 'required',
            'absent_personnel' => 'required',
            'training_absence' => 'required',
            'leave_absence' => 'required',
            'compensatory_leave' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('taxes', $this->route('unit'))
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('unit')
        ]);
    }

}
