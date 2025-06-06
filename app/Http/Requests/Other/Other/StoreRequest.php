<?php

namespace App\Http\Requests\Other\Other;

use App\Rules\UniqueEntryDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('others', $this->route('id'))
            ],
        ];
    }
}
