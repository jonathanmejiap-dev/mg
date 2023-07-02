<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){
        if(str($this->slug)->trim() == ""){
            $this->merge([
                'slug' => str($this->title)->slug()
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|min:5|max:255",
            "slug" => "required|min:5|max:255|unique:posts",
            "date" => "required",
            "description" => "required",
            "text" => "required",
            "posted" => "required",
            "type" => "required",
            "category_id" => "required",
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240',
            
        ];
    }
}
