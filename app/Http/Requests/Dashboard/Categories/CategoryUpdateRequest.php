<?php

namespace App\Http\Requests\Dashboard\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   /*  public function authorize(): bool
    {
        return false;
    } */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
        ];
    }
}