<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200|unique:blog_categories,slug',
            'description' => 'nullable|string|max:500|min:5',
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
        ];
    }

    public function prepareForValidation()
    {
        // Generate slug from title before validation if it empty
        if ($this->has(['slug','title']) && $this->filled('title') && !$this->filled('slug')){
            $this->request->set('slug', str_slug($this->title));
        }
    }
}
