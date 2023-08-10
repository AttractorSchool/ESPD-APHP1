<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event.title' => 'required',
            'event.description' => 'required',
            'event.date' => 'required',
            'event.location' => 'required',
            'event.price' => 'required',
            'event.quantity' => 'required',
            'event.picture' => 'required',
            'event.format' => 'required',
            'event.author_id' => 'required',
        ];
    }
}
