<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryUploadChapterRequest extends FormRequest
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
            'story' => 'required',
            'content_chapter' => 'required',
            'order_chapter' => 'required|min:1',
            'link_audio_play' => 'required',
            'image_cover' => 'mimes:jpeg,jpg,png,svg,gif,bmp|max:8000'
        ];
    }
}
