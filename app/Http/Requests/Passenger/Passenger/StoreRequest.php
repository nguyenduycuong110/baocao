<?php

namespace App\Http\Requests\Passenger\Passenger;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Passenger is authorized to make this request.
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
            'departure' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('passengers', $this->route('id'))
            ],
        ];
    }
}
