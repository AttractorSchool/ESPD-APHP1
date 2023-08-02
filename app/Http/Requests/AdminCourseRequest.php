<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCourseRequest extends FormRequest
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
            'course.name' => 'required|min:5|max:255|string',
            'course.author_id' => 'required|integer',
            'course.interest_id' => 'required|integer',
            'course.mini_description' => 'required|min:5|max:255|string',
            'course.description' => 'required|min:5|max:5000|string',
        ];
    }
}
