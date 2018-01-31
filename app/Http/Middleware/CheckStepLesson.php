<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\ReadingLessonService;
use App\Services\ReadingStatusLearningOfUserService;

class CheckStepLesson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $type_lesson_id = getIdFromLink($request->route('type_lesson_id'));
        $lesson_id = getIdFromLink($request->route('lesson_id'));
        $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
        $readingLessonService = new ReadingLessonService();
        $lesson = $readingLessonService->getLessonDetailForClientMiddleware($type_lesson_id, $lesson_id);
        if ($lesson != null) {
            $level_user_of_lesson = $lesson->level_user_id;
            $level_user_current = Auth::user()->level_user_id;
            if ($level_user_current != 1 && $level_user_of_lesson > $level_user_current) {
                $message = ['flash_level'=>'warning message-custom','flash_message'=>'Please upgrade your account to PRO!!!'];
                return redirect()->intended('reading')->with($message);
            }
            else {
                $step_lesson_current = $readingLessonService->getCurrentStepOfLesson($type_lesson_id, $lesson_id);
                if($type_lesson_id > 2) {
                    $type_question_id_current = 0;
                    $level_lesson_id = $lesson->level_lesson_id;
                }
                else {
                    $type_question_id_current = $lesson->type_question_id;
                    if ($type_question_id_current < 0) {
                        return $next($request);
                    }
                    else {
                        $level_lesson_id = $lesson->typeQuestion->levelLesson->id;
                    }
                }
                $your_max_step = $readingStatusLearningOfUserService->getHighestStepLessonService($level_lesson_id, $type_question_id_current, $type_lesson_id);
                if($your_max_step >= $step_lesson_current)
                {
                    return $next($request);
                }
                else{
                    $message = ['flash_level'=>'warning message-custom','flash_message'=>'Please unlock before other lessons!!!'];
                    return redirect()->intended('reading/' . $level_lesson_id)->with($message);
                }
            }
        }
        else {
            abort(404);
        }
    }
}

