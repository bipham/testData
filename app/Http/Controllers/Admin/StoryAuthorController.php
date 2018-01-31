<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\StoryAuthorService;
use App\Http\Requests\StoryCreateAuthorRequest;
class StoryAuthorController extends Controller
{
    public function getCreateNewAuthorStory($domain) {
        return view('admin.storyCreateNewAuthor');
    }

    public function postCreateNewAuthorStory($domain, StoryCreateAuthorRequest $request) {
        $validator = validator($request->All(), $request->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $name = $request->name;
            $avatar = $request->file('image_feature');
            $introduction = $request->introduction;
            $storyAuthorService = new StoryAuthorService();
            $result = $storyAuthorService->createNewAuthorStory($name, $avatar, $introduction);
            if ($result == 'success') {
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo author story thành công!'];
            }
            else {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Author story này đã tồn tại!'];
            }
            return redirect()->back()->with($message);
        }
    }
}
