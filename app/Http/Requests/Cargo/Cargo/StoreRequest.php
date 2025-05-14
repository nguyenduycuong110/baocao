<?php

namespace App\Http\Requests\Cargo\Cargo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Cargo is authorized to make this request.
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
            'green_channel' => 'required',
            'yellow_channel' => 'required',
            'red_channel' => 'required',
            'void_declaration' => 'required',
            'green_channel_import' => 'required',
            'yellow_channel_import' => 'required',
            'red_channel_import' => 'required',
            'void_declaration_import' => 'required',
            'temp_import' => 'required',
            'reexport' => 'required',
            'overdue_not_reexported' => 'required',
            'export_turnover' => 'required',
            'import_turnover' => 'required',
            'taxable_export_turnover' => 'required',
            'taxable_import_turnover' => 'required',
            'outgoing_transit' => 'required',
            'incoming_transit' => 'required',
            'outgoing_transit_turnover' => 'required',
            'incoming_transit_turnover' => 'required',
        ];
    }
}
