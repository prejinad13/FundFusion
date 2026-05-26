<?php

namespace App\Http\Requests\Idea;

use Illuminate\Foundation\Http\FormRequest;

class EditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name'=>'required',
            'video_link'=>'required',
            'team_size'=>'required',
            'required_investment_amount'=>'required',
            'return_on_investment'=>'required',
            'short_description'=>'required',
            'long_description'=>'required'
         ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Idea name required',
            'video_link.required'=>'Explanation Video required',
            'team_size.required'=>'Team size required',
            'required_investment_amount.required'=>'Investment Amount required',
            'return_on_investment.required'=>'ROI required',
            'short_description.required'=>'Short description required',
            'long_description.required'=>'Main description required'
        ];
    }
}
