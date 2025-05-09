<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandRequest extends FormRequest
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
            'name' => 'required|min:3|max:256',
            'member_id' => 'required',
            'description' => 'nullable',
            'genre' => 'required|min:3|max:256',
            'formed_year' => 'numeric|nullable',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ];
    }
}
