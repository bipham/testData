<?php namespace App\Services;

use App\Models\ReadingLearningTypeQuestion;
use Illuminate\Support\Facades\Auth;

class ReadingLearningTypeQuestionService {
    private $_readingLearningTypeQuestionModel;

    private $_adminId;

    public function __construct()
    {
        $this->_readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
        $this->_adminId = Auth::id();
    }

    public function createNewLearningTypeQuestion($level_user_id, $type_question_id, $title, $order_lesson, $view_layout, $icon, $content_section, $left_content, $right_content, $content_answer_quiz, $content_highlight, $total_questions) {
        return $this->_readingLearningTypeQuestionModel->createNewLearningTypeQuestion($level_user_id, $type_question_id, $title, $order_lesson, $view_layout, $icon, $content_section, $left_content, $right_content, $content_answer_quiz, $content_highlight, $total_questions, $this->_adminId);
    }

    public function getLearningOfTypeQuestion($type_question_id) {
        return $this->_readingLearningTypeQuestionModel->getLearningOfTypeQuestion($type_question_id);
    }

    public function getLearningDetail($learning_id) {
        return $this->_readingLearningTypeQuestionModel->getLearningDetail($learning_id);
    }
}
?>