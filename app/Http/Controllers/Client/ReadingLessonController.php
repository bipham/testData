<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReadingLessonService;
use App\Services\ReadingLearningTypeQuestionService;
use App\Services\ReadingStatusLearningOfUserService;
use App\Services\ReadingTypeQuestionService;
use App\Services\ReadingMixTestService;
use App\Services\ReadingFullTestService;
use App\Services\ReadingLevelLessonService;

class ReadingLessonController extends Controller
{
    public function overViewLevelLesson($domain, $string_level_lesson)
    {
        $level_lesson_id = getIdFromLink($string_level_lesson);
        $readingTypeQuestionService = new ReadingTypeQuestionService();
        $readingMixTestService = new ReadingMixTestService();
        $readingFullTestService = new ReadingFullTestService();
        $readingLearningTypeQuestionService = new ReadingLearningTypeQuestionService();
        $readingLevelLessonService = new ReadingLevelLessonService();
        $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
        $current_level_lesson = $readingLevelLessonService->getLevelLessonById($level_lesson_id);
        $all_type_questions = $readingTypeQuestionService->getAllTypeQuestionById($level_lesson_id);
        $mix_tests = $readingMixTestService->getAllMixTestLessons($level_lesson_id);
        $full_tests = $readingFullTestService->getAllFullTest($level_lesson_id);
        $all_introductions = $readingLearningTypeQuestionService->getLearningOfTypeQuestion(-$level_lesson_id);
        $type_lesson_id = null;
        $type_question_id = null;

        $readingLessonService = new ReadingLessonService();
        $lesson_resume = $readingLessonService->getResumeLesson($level_lesson_id);
        return view('client.readingOverview', compact('level_lesson_id', 'type_question_id', 'all_level_lessons', 'current_level_lesson', 'all_type_questions', 'all_introductions', 'mix_tests', 'full_tests', 'type_lesson_id', 'lesson_resume'));
    }

    public function readingOverviewDetail($domain, $string_level_lesson, $string_type_lesson, $string_type_question_id)
    {
        $level_lesson_id = getIdFromLink($string_level_lesson);
//        $type_lesson_id = getIdFromLink($string_type_lesson);
        $type_lesson_id = $string_type_lesson;
        $type_question_id = getIdFromLink($string_type_question_id);
        $readingTypeQuestionService = new ReadingTypeQuestionService();
        $readingMixTestService = new ReadingMixTestService();
        $readingFullTestService = new ReadingFullTestService();
        $readingLearningTypeQuestionService = new ReadingLearningTypeQuestionService();
        $readingLevelLessonService = new ReadingLevelLessonService();
        $readingLessonService = new ReadingLessonService();
        $all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
        $current_level_lesson = $readingLevelLessonService->getLevelLessonById($level_lesson_id);
        $all_type_questions = $readingTypeQuestionService->getAllTypeQuestionById($level_lesson_id);
        $mix_tests = $readingMixTestService->getAllMixTestLessons($level_lesson_id);
        $full_tests = $readingFullTestService->getAllFullTest($level_lesson_id);
        $all_introductions = $readingLearningTypeQuestionService->getLearningOfTypeQuestion(-$level_lesson_id);
        $readingLessonService = new ReadingLessonService();
        $lesson_resume = $readingLessonService->getResumeLessonOverDetail($level_lesson_id, $type_lesson_id, $type_question_id);
        if ($type_lesson_id < 0) {
            $type_question_name = 'Introductions';
        }
        else if ($type_lesson_id >= 0 && $type_lesson_id < config('constants.type_lesson.mix_test')) {
            $type_question_name = $readingTypeQuestionService->getTypeQuestionName($type_question_id);
            $all_mini_tests = $readingLessonService->getLessonsByTypeQuestionId(Config('constants.type_lesson.mini_test'), $type_question_id);
            $all_learnings = $readingLearningTypeQuestionService->getLearningOfTypeQuestion($type_question_id);
            $all_practices = $readingLessonService->getLessonsByTypeQuestionId(Config('constants.type_lesson.practice'), $type_question_id);
            return view('client.readingOverview', compact('level_lesson_id', 'type_lesson_id', 'type_question_id', 'type_question_name', 'all_level_lessons', 'current_level_lesson', 'all_type_questions', 'all_introductions', 'mix_tests', 'full_tests', 'type_lesson_id', 'all_learnings', 'all_practices', 'all_mini_tests', 'lesson_resume'));
        }
        else if ($type_lesson_id == 3) {
            $type_question_name = 'Mix Test';
        }
        else {
            $type_question_name = 'Full Test';
        }
        return view('client.readingOverview', compact('level_lesson_id', 'type_lesson_id', 'type_question_name', 'all_level_lessons', 'current_level_lesson', 'all_type_questions', 'all_introductions', 'mix_tests', 'full_tests', 'lesson_resume', 'type_lesson_id'));
    }

    public function readingLessonDetail($domain, $string_level_lesson, $string_type_lesson, $string_lesson) {
        $level_lesson_id = getIdFromLink($string_level_lesson);
        $type_lesson_id = getIdFromLink($string_type_lesson);
        $lesson_id_current = getIdFromLink($string_lesson);
        $readingLessonService = new ReadingLessonService();
        $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
        $lesson = $readingLessonService->getLessonDetailForClientTestById($type_lesson_id, $lesson_id_current);
        if ($type_lesson_id > 2) {
            $type_question_id_current = 0;
        }
        else {
            $type_question_id_current = $lesson->type_question_id;
        }
        $your_max_step = $readingStatusLearningOfUserService->getHighestStepLessonService($level_lesson_id, $type_question_id_current, $type_lesson_id);
        $min_step = $readingLessonService->getMinStepLesson($level_lesson_id, $type_question_id_current, $type_lesson_id);
        $max_step = $readingLessonService->getMaxStepLesson($level_lesson_id, $type_question_id_current, $type_lesson_id);
        if ($type_lesson_id == 4) {
            $pre_lesson_id = $readingLessonService->getPreLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson['lesson_detail']->order_lesson);
            $next_lesson_id = $readingLessonService->getNextLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson['lesson_detail']->order_lesson);
        }
        else {
            $pre_lesson_id = $readingLessonService->getPreLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson->order_lesson);
            $next_lesson_id = $readingLessonService->getNextLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson->order_lesson);
        }
        switch ($type_lesson_id) {
            case 1:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingLessonDetail', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                }
                else {
                    return abort(404);
                }
                break;
            case 2:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewTestDetail', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                }
                else {
                    return abort(404);
                }
                break;
            case 3:
                $title_current_step = $lesson->title;
                if ($lesson->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewTestDetail', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                }
                else {
                    return abort(404);
                }
               break;
            case 4:
                $title_current_step = $lesson['lesson_detail']->title;
                $lesson_detail = $lesson['lesson_detail'];
                $paragraphs = $lesson['paragraph_detail'];
                return view('client.readingViewFullTestDetail', compact('lesson_id_current', 'level_lesson_id', 'lesson_detail', 'paragraphs', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                break;
        }
    }

    public function getReadingViewLearning($domain, $string_level_lesson, $string_type_lesson, $string_lesson) {
        $level_lesson_id = getIdFromLink($string_level_lesson);
        $type_lesson_id = getIdFromLink($string_type_lesson);
        $lesson_id_current = getIdFromLink($string_lesson);
        $readingLearningTypeQuestionService = new ReadingLearningTypeQuestionService();
        $readingLessonService = new ReadingLessonService();
        $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
        $lesson = $readingLearningTypeQuestionService->getLearningDetail($lesson_id_current);
        $title_current_step = $lesson->title;
        if ($type_lesson_id > 2) {
            $type_question_id_current = 0;
        }
        else {
            $type_question_id_current = $lesson->type_question_id;
        }
        $your_max_step = $readingStatusLearningOfUserService->getHighestStepLessonService($level_lesson_id, $type_question_id_current, $type_lesson_id);
        $min_step = $readingLessonService->getMinStepLesson($level_lesson_id, $type_question_id_current, $type_lesson_id);
        $max_step = $readingLessonService->getMaxStepLesson($level_lesson_id, $type_question_id_current, $type_lesson_id);
        $pre_lesson_id = $readingLessonService->getPreLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson->order_lesson);
        $next_lesson_id = $readingLessonService->getNextLessonId($level_lesson_id, $type_question_id_current, $type_lesson_id, $lesson->order_lesson);
        return view('client.readingViewLearning', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
    }

    public function getReading($domain) {
        return view('client.reading');
    }
}