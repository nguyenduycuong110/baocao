<?php

namespace App\Http\Requests\Risk\Risk;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryDate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the Risk is authorized to make this request.
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
            'flow_decl' => 'required',
            'stop_via_supervision' => 'required',
            'violated_decl' => 'required',
            'collect_bus_info' => 'required',
            'prop_disb_setup' => 'required',
            'act_disb_setup' => 'required',
            'item_profile_set' => 'required',
            'bus_profile_set' => 'required',
            'entry_date' => [
                'required',
                'date_format:d/m/Y',
                new UniqueEntryDate('risks', $this->route('risk'))
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('risk')
        ]);
    }

}
