<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReadingLevelLessonService;
use App\Services\ReadingTypeQuestionService;
use App\Services\ReadingQuestionLearningService;
use App\Services\ReadingLearningTypeQuestionService;
use App\Services\ReadingLessonService;
use App\Services\ReadingLevelUserService;

class ReadingLearningTypeQuestionController extends Controller
{
    public function getCreateNewLearningTypeQuestion($domain) {
        $readingLevelLessonService = new ReadingLevelLessonService();
        $all_levels = $readingLevelLessonService->getAllLevelLesson();
        $first_level_lesson_id = $readingLevelLessonService->getFirstLevelLesson();
        $readingTypeQuestionService = new ReadingTypeQuestionService();
        $all_type_questions = $readingTypeQuestionService->getAllTypeQuestionById($first_level_lesson_id->id);
        $readingQuestionLearningService = new ReadingQuestionLearningService();
        $last_question_custom_id = $readingQuestionLearningService->getTheLastQuestionCustomId();
        $readingLevelUserService = new ReadingLevelUserService();
        $all_level_users = $readingLevelUserService->getAllLevelUser();
        return view('admin.readingCreateNewLearningTypeQuestion', compact('all_type_questions', 'all_levels', 'last_question_custom_id', 'all_level_users'));
    }

    public function postCreateNewLearningTypeQuestion($domain) {
        $type_question_id = $_POST['type_question_id'];
        $title = $_POST['title'];
        $name_icon_section = $_POST['name_icon_section'];
        if ($name_icon_section == '') {
            $name_icon_section = 'fa-cog';
        }
        $content_section = $_POST['content_section'];
        $left_section = $_POST['left_section'];
        $right_section = $_POST['right_section'];
        $order_lesson = $_POST['order_lesson'];
        $view_layout = $_POST['view_layout'];
        $list_answer = $_POST['list_answer'];
        $list_type_questions = $_POST['list_type_questions'];
        $level_user_id = $_POST['level_user_id'];
        $listKeyword = $_POST['listKeyword'];
        $content_answer_quiz = $_POST['content_answer_quiz'];
        $content_highlight = $_POST['content_highlight'];
        $total_questions = sizeof($list_answer);
        $readingLearningTypeQuestionService = new ReadingLearningTypeQuestionService();
        $result = $readingLearningTypeQuestionService->createNewLearningTypeQuestion($level_user_id, $type_question_id, $title, $order_lesson, $view_layout, $name_icon_section, $content_section, $left_section, $right_section, $content_answer_quiz, $content_highlight, $total_questions);
        if ($result != 'fail-title' && $result != 'fail-step') {
            if ($list_answer != 'null') {
                $learning_type_question_id = $result;
                foreach ($list_answer as $question_custom_id => $answer) {
                    $readingQuestionLearningService = new ReadingQuestionLearningService();
                    $readingQuestionLearningService->addNewQuestionLearning($learning_type_question_id, $type_question_id, $question_custom_id, $answer, $listKeyword[$question_custom_id]);
                }
            }
            $readingLessonService = new ReadingLessonService();
            if ($type_question_id >= 0) {
                $readingTypeQuestionService = new ReadingTypeQuestionService();
                $level_lesson_id = $readingTypeQuestionService->getLevelLessonIdByTypeQuestion($type_question_id);
            }
            else {
                $level_lesson_id = - $type_question_id;
            }
            $readingLessonService->newUpdateTotalTypeLesson($level_lesson_id, config('constants.type_lesson.learning'), $type_question_id);
        }
        return json_encode(['result' => $result]);
    }
}
