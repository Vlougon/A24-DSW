<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueStoreRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'starting_date' => ['required'],
            'ending_date' => ['required'],
            'state' => ['required', 'in:ended,still_to_do,on_it,failed'],
            'region' => ['required', 'string'],
        ];
    }
}
