<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_ar' => request()->method() == 'POST' ? 'required|string|min:3|max:255|unique:categories,name_ar' : 'required|string|min:3|max:255|unique:categories,name_ar,' . $this->id,
            'name_en' =>  request()->method() == 'POST' ? 'required|string|min:3|max:255|unique:categories,name_en' : 'required|string|min:3|max:255|unique:categories,name_en,' . $this->id,
            'image' =>  'required'
        ];
    }
}
