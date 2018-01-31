<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UcenduUserService;
use App\Services\ReadingLessonService;
use App\Services\ReadingLevelLessonService;
use App\Services\ReadingStatusLearningOfUserService;
use App\Http\Requests\OnlyImageRequest;
use Validator;

class UserController extends Controller
{
    public function getChangePassword () {
        return view('auth.changePassword');
    }

    public function postChangePassword (Request $request) {
        $ucenduUserService = new UcenduUserService();
        $new_password = $request->password;
        $ucenduUserService->updateNewPasswordOfUser($new_password);
        return redirect()->intended('/');
    }

    public function userChangePassword ($domain, $user_id, Request $request) {
        $request_data = $request->All();
        $validator = $this->password_rules($request_data);
        if($validator->fails())
        {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $ucenduUserService = new UcenduUserService();
            $current_password = $request->current_password;
            $checkPasswordStatus = $ucenduUserService->checkPasswordCurrent($user_id, $current_password);
            if ($checkPasswordStatus) {
                $new_password = $request->password;
                $ucenduUserService->updateNewPasswordOfUser($new_password);
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Your password was changed!'];
            }
            else {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Error!!! Please check password again!'];
            }
            return redirect()->intended('profile/' . $user_id)->with($message);
        }
    }

    public function viewProfile($domain, $user_id) {
        $ucenduUserService = new UcenduUserService();
        $checkStatusUser = $ucenduUserService->checkStatusUser($user_id);
        if ($checkStatusUser) {
            $readingLessonService = new ReadingLessonService();
            $readingLevelLessonService = new ReadingLevelLessonService();
            $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
            $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
            $user_info = $ucenduUserService->getUserInfo($user_id);
            foreach ($all_level_lessons as $index_level => $level_lesson) {
                $total_lessons = $readingLessonService->getTotalLessonByLevelLesson($level_lesson->id);
                $lesson_finished = $readingStatusLearningOfUserService->getLessonFinishedByLevelLesson($level_lesson->id, $user_id);
                $percent_finished = ($lesson_finished/$total_lessons) * 100;
                $percent_finished = round($percent_finished, 2);
                $all_level_lessons[$index_level]->percent_finished = $percent_finished;
            }
            return view('client.profileUser', compact('user_info', 'all_level_lessons'));
        }
        else {
            return abort('404');
        }
    }

    public function updateAvatar($domain, $user_id, OnlyImageRequest $request) {
        $validator = validator($request->All(), $request->rules());
        if($validator->fails())
        {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $ucenduUserService = new UcenduUserService();
            $updateAvatarStatus = $ucenduUserService->updateAvatar($user_id, $request);
            if ($updateAvatarStatus == 'update-fail') {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Update Avatar fail, please check your avatar and try again!'];
                return redirect()->intended('profile/' . $user_id)->with($message);
            }
            elseif ($updateAvatarStatus == 'not-permission') {
                $message = ['flash_level'=>'warning message-custom','flash_message'=>'You not have permission, please contact to admin for more infomations!'];
                return redirect()->intended('profile/' . $user_id)->with($message);
            }
            else {
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Your avatar was changed!'];
                return redirect()->intended('profile/' . $updateAvatarStatus)->with($message);
            }
        }
    }

    public function password_rules(array $data)
    {
        $messages = [
            'current_password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|same:password|min:6',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }

}
