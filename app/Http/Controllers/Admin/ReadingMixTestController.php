<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReadingQuestionLessonService;
use App\Services\ReadingLessonService;

class ReadingMixTestController extends Controller
{
    public function getEditMixTest($domain, $lesson_id) {
        $readingQuestionLessonService = new ReadingQuestionLessonService();
        $last_question_custom_id = $readingQuestionLessonService->getTheLastQuestionCustomId();
        $readingLessonService = new ReadingLessonService();
        $lesson = $readingLessonService->getLessonDetailForAdminById(Config('constants.type_lesson.mix_test'), $lesson_id);
//        dd($lesson);
        return view('admin.readingEditPracticeLesson',compact('last_question_custom_id', 'lesson'));
    }
}
