<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStoryEnglishRequest extends FormRequest
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
            'title' => 'required',
            'story_level' => 'required',
            'story_genre' => 'required',
            'story_length' => 'required',
            'author' => 'required',
            'description' => 'max:350',
            'image_cover' => 'mimes:jpeg,jpg,png,svg,gif,bmp|max:8000'
        ];
    }
}
