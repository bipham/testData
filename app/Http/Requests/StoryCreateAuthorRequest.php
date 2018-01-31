<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryCreateAuthorRequest extends FormRequest
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
            'name' => 'required',
            'introduction' => 'max:350',
            'image_feature' => 'mimes:jpeg,jpg,png,svg,gif,bmp|max:8000'
        ];
    }
}
