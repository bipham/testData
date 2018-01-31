<?php namespace App\Services;

use App\Models\ReadingQuestionLesson;

class ReadingQuestionLessonService {
    private $_readingQuestionLessonModel;

    public function __construct()
    {
        $this->_readingQuestionLessonModel = new ReadingQuestionLesson();
    }

    public function getTheLastQuestionCustomId() {
        $last_question_custom = $this->_readingQuestionLessonModel->getTheLastQuestionCustomId();
        if (!$last_question_custom) {
            $last_question_custom_id = 1;
        }
        else {
            $last_question_custom_id = $last_question_custom->question_custom_id + 1;
        }
        return $last_question_custom_id;
    }

    public function addNewQuestionLesson($type_lesson_id, $lesson_id, $type_question_id, $question_custom_id, $answer, $keyword) {
        return $this->_readingQuestionLessonModel->addNewQuestionLesson($type_lesson_id, $lesson_id, $type_question_id, $question_custom_id, $answer, $keyword);
    }

    public function updateQuestionType($type_lesson_id, $lesson_id, $type_question_id) {
        return $this->_readingQuestionLessonModel->updateQuestionType($type_lesson_id, $lesson_id, $type_question_id);
    }

    public function deleteQuestionLesson($type_lesson_id, $lesson_id, $question_custom_id) {
        return $this->_readingQuestionLessonModel->deleteQuestionLesson($type_lesson_id, $lesson_id, $question_custom_id);
    }

    public function getExplanation($question_custom_id) {
        $explanation = $this->_readingQuestionLessonModel->getExplanation($question_custom_id);
        return $explanation['keyword'];
    }

    public function getListTypeQuestionDetail($type_lesson_id, $lesson_id) {
        $result = [];
        $list_type_questions = $this->_readingQuestionLessonModel->getListTypeQuestionDetail($type_lesson_id, $lesson_id);
        foreach ($list_type_questions as $index => $type_question) {
            $result[$type_question->question_custom_id] = $type_question->type_question_id;
        }
//        dd($result);
        return $result;
    }
}
?>