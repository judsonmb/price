<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required|exists:projects,id',
            'ali_justify' => 'max:255',
            'aie_justify' => 'max:255',
            'ee_justify' => 'max:255',
            'se_justify' => 'max:255',
            'ce_justify' => 'max:255',
        ];
    }
}
