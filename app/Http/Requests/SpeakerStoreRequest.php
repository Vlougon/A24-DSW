<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'conference_id' => ['required', 'integer', 'exists:conferences,id'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'biografy' => ['required', 'string'],
            'twitter' => ['required', 'string'],
        ];
    }
}
