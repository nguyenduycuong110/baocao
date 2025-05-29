<?php

namespace App\Http\Requests\Unit\Unit;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class StoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'total_unit_personnel' => 'required',
            'present_personnel' => 'required',
            'leadership_duty' => 'required',
            'absent_personnel' => 'required',
            'training_absence' => 'required',
            'leave_absence' => 'required',
            'compensatory_leave' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('units', $this->route('id'))
            ],
        ];
    }
}
