<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class InstructorsRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => request()->method() == 'POST' ? 'required|string|email|max:255|unique:users' : 'required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => request()->method() == 'POST' ? 'required|string|min:8|max:255' : '',
            'phone' => request()->method() == 'POST' ? 'required|string|min:10|max:255|unique:users' : 'required|string|min:10|max:255|unique:users,phone,' . $this->id,
            'username' => request()->method() == 'POST' ? 'required|string|min:2|max:255|unique:users' : 'required|string|min:2|max:255|unique:users,username,' . $this->id,
            'public_name' => 'required|string|min:2|max:255',
            'skills'=> 'required|array',
            'skills.*'=> 'required|string',
            'bio' => 'required|string|min:10|max:255',
            // 'avatar' =>  request()->method() == 'POST' ? 'required|mimes:jpeg,png,jpg,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,svg|max:2048',
            // 'background_image' => request()->method() == 'POST' ? 'required|mimes:jpeg,png,jpg,svg|max:2048' : 'nullable|mimes:jpeg,png,jpg,svg|max:2048',
            'facebook' => 'nullable|string|url',
            'twitter' => 'nullable|string|url',
            'linkedin' => 'nullable|string|url',
            'website' => 'nullable|string|url',
            'github' => 'nullable|string|url',
            'avatar' => 'required',

            'background_image'=>'required'
        ];
    }
}
