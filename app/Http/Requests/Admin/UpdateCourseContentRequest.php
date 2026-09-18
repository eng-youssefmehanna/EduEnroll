<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'               => ['required', 'string', 'max:255'],
            'type'                => ['required', 'in:video,pdf,text'],
            'content_url_or_text' => ['required', 'string'],
            'order'               => ['required', 'integer', 'min:1'],
        ];
    }
}