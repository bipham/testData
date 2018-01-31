<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReadingLessonService;
use App\Services\ReadingResultService;
use App\Services\ReadingStatusLearningOfUserService;
use App\Services\ReadingQuestionLessonService;
use App\Services\ReadingQuestionAnswerLessonService;
use App\Services\UcenduUserService;
use App\Services\ReadingQuestionLearningService;
use App\Models\ReadingPracticeLesson;

class ReadingResultController extends Controller
{
    //Ajax function get result after user submit:
    public function getResultReadingLesson($domain, $level_lesson_id, $type_lesson_id, $lesson_id) {
        $list_answered = $_GET['list_answer'];
        $readingResultService = new ReadingResultService();
        $readingLessonService = new ReadingLessonService();

        //Get correct answer:
        $total_questions = $readingLessonService->getTotalQuestionByLessonId($type_lesson_id, $lesson_id);
        $correct_answer = $readingResultService->getResultLesson($type_lesson_id, $lesson_id, $list_answered);
        return json_encode(['correct_answer' => $correct_answer, 'total_questions' => $total_questions]);
    }

    public function getReadingViewResultLesson($domain, $string_level_lesson, $string_type_lesson, $string_lesson) {
        //Get para:
        $level_lesson_id = getIdFromLink($string_level_lesson);
        $type_lesson_id = getIdFromLink($string_type_lesson);
        $lesson_id_current = getIdFromLink($string_lesson);
        if (!empty($_GET)) {
            $total_questions = $_GET['total_questions'];
            $correct_answer = $_GET['correct_answer'];
            $list_answer = $_GET['list_answer'];
        }
        else {
            $total_questions = 0;
            $correct_answer = [];
            $list_answer = [];
        }
        $correct_answer = json_decode($correct_answer);
        $list_answer = json_decode($list_answer);
        $readingLessonService = new ReadingLessonService();
        $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
        $lesson = $readingLessonService->getLessonDetailForClientSolutionById($type_lesson_id, $lesson_id_current);
        $step_lesson_current = $readingLessonService->getCurrentStepOfLesson($type_lesson_id, $lesson_id_current);

        if($type_lesson_id > 2) $type_question_id_current = 0;
        else $type_question_id_current = $lesson->type_question_id;
        $readingStatusLearningOfUserService->checkNextStepLesson($level_lesson_id, $type_lesson_id, $type_question_id_current, $correct_answer, $total_questions, $step_lesson_current);
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
            case 0:
                $title_current_step = $lesson->title;
                return view('client.readingViewResultLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                break;
            case 1:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewResultLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                }
                else {
                    return abort(404);
                }
                break;
            case 2:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewResultLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                }
                else {
                    return abort(404);
                }
                break;
            case 3:
                $title_current_step = $lesson->title;
                return view('client.readingViewResultLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                break;
            case 4:
                $title_current_step = $lesson['lesson_detail']->title;
                $lesson_detail = $lesson['lesson_detail'];
                $paragraphs = $lesson['paragraph_detail'];
                return view('client.readingViewSolutionOfFullTest', compact('lesson_id_current', 'level_lesson_id', 'lesson_detail', 'paragraphs', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step'));
                break;
        }
    }

    public function getReadingViewSolutionLesson($domain, $string_level_lesson, $string_type_lesson, $string_lesson) {
        //Get para:
        $level_lesson_id = getIdFromLink($string_level_lesson);
        $type_lesson_id = getIdFromLink($string_type_lesson);
        $lesson_id_current = getIdFromLink($string_lesson);
        $readingLessonService = new ReadingLessonService();
        $readingStatusLearningOfUserService = new ReadingStatusLearningOfUserService();
        $lesson = $readingLessonService->getLessonDetailForClientSolutionById($type_lesson_id, $lesson_id_current);
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
        $readingResultService = new ReadingResultService();
        $top_highest_scores = $readingResultService->getTopHighestScores($type_lesson_id, $lesson_id_current);
        switch ($type_lesson_id) {
            case 0:
                $title_current_step = $lesson->title;
                return view('client.readingViewSolutionLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step', 'top_highest_scores'));
                break;
            case 1:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewSolutionLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step', 'top_highest_scores'));
                }
                else {
                    return abort(404);
                }
                break;
            case 2:
                $title_current_step = $lesson->title;
                if ($lesson->typeQuestion->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewSolutionLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step', 'top_highest_scores'));
                }
                else {
                    return abort(404);
                }
                break;
            case 3:
                $title_current_step = $lesson->title;
                if ($lesson->level_lesson_id == $level_lesson_id) {
                    return view('client.readingViewSolutionLesson', compact('lesson_id_current', 'level_lesson_id', 'lesson', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step', 'top_highest_scores'));
                }
                else {
                    return abort(404);
                }
                break;
            case 4:
                $title_current_step = $lesson['lesson_detail']->title;
                $lesson_detail = $lesson['lesson_detail'];
                $paragraphs = $lesson['paragraph_detail'];
                return view('client.readingViewSolutionOfFullTest', compact('lesson_id_current', 'level_lesson_id', 'lesson_detail', 'paragraphs', 'correct_answer', 'total_questions', 'list_answer', 'title_current_step', 'type_question_id_current', 'type_lesson_id', 'min_step', 'max_step', 'pre_lesson_id', 'next_lesson_id', 'your_max_step', 'top_highest_scores'));
                break;
        }
    }

    //Ajax get comments + explanation:
    public function getExplanation($domain, $type_lesson_id, $question_custom_id) {
        $readingQuestionLessonService = new ReadingQuestionLessonService();
        $readingQuestionAnswerLessonService = new ReadingQuestionAnswerLessonService();
        $ucenduUserService = new UcenduUserService();

        //Get explanation:
        if ($type_lesson_id > 0) {
            $explanation = $readingQuestionLessonService->getExplanation($question_custom_id);
        }
        else {
            $readingQuestionLearningService = new ReadingQuestionLearningService();
            $explanation = $readingQuestionLearningService->getExplanation($question_custom_id);
        }
        //Get comments:
        $list_comments = $readingQuestionAnswerLessonService->getAllCommentsOfQuestion($type_lesson_id, $question_custom_id);

        $current_user_info = $ucenduUserService->getLevelCurrentUser();

        return json_encode(['explanation' => $explanation, 'list_comments' => $list_comments, 'current_user_info' => $current_user_info]);
    }
}
