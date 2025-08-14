<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:150', Rule::unique('posts', 'title')->ignore($this->post)],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date', 'required_if:status,published'],
            'body' => ['required', 'string', 'min:10']
        ];
    }
}