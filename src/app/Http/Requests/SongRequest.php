<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
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
            'artist_id' => 'required',
            'album_id' => 'required',
            'description' => 'nullable',
            'year' => 'numeric|nullable',
            'spotify' => 'nullable|string|starts_with:https://open.spotify.com/track/',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ];
    }
}
