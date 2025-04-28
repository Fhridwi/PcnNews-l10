<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'summary' => 'required|string',
        'content' => 'required|string',
        'cover_image_url' => 'required',
        'publish_status' => 'required|in:draft,published,archived,private',
        'published_at' => 'nullable|date',
        'view_count' => 'null|numeric|min:0',
    ];
}

}
