<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishStoreRequest extends FormRequest
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
            'name' => 'required|unique:dishes|max:255',
            'category_id' => 'required',
            'dish_image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Dish name need to fill',
        ];
    }
}
