<?php

namespace App\Http\Requests\Vehicle\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Vehicle is authorized to make this request.
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
            'car_exit' => 'required',
            'boats_exit' => 'required',
            'car_entry' => 'required',
            'boats_entry' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('vehicles', $this->route('id'))
            ],
        ];
    }
}
