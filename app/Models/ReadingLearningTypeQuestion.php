<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingLearningTypeQuestion extends Model
{
    protected $table = 'reading_learning_type_questions';

    protected $fillable = ['level_user_id', 'type_question_id', 'order_lesson', 'title', 'view_layout', 'icon', 'content_section', 'left_content', 'right_content', 'content_answer_quiz', 'content_highlight', 'total_questions', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function typeQuestion()
    {
        return $this->belongsTo('App\Models\ReadingTypeQuestion', 'type_question_id');
    }

    public function questionLearnings()
    {
        return $this->hasMany('App\Models\reading_question_learnings', 'learning_type_question_id');
    }

    public function getLearningOfTypeQuestion($type_question_id) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->orderBy('order_lesson', 'asc')->select('id', 'level_user_id', 'total_questions', 'title', 'icon', 'order_lesson')->get()->all();
    }

    public function getTotalLearningByTypeQuestionId($type_question_id) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->count();
    }

    public function getLearningDetail($learning_id) {
        return $this->where('status',1)->where('id', $learning_id)->select('id', 'order_lesson', 'type_question_id', 'title', 'view_layout', 'content_section', 'left_content', 'right_content', 'total_questions')->get()->first();
    }

    public function getLessonResume($lesson_id) {
        return $this->where('id', $lesson_id)->select('id', 'type_question_id', 'order_lesson', 'total_questions')->get()->first();
    }

    public function getTotalQuestionOfLearning($lesson_id) {
        return $this->where('id', $lesson_id)->select('total_questions')->get()->first();
    }

    public function getDetailLearningForClientSolution($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'view_layout', 'title', 'content_highlight', 'content_answer_quiz', 'order_lesson', 'total_questions', 'type_question_id')->get()->first();
    }

    public function getDetailLearningForClientMiddleware($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'level_user_id', 'type_question_id')->get()->first();
    }

    public function getCurrentStepOfLearning($lesson_id) {
        return $this->where('id', $lesson_id)->select('order_lesson')->get()->first();
    }

    public function checkVipLearning($lesson_id) {
        return $this->where('id', $lesson_id)->select('level_user_id')->get()->first();
    }

    public function getMinStepOfLearning($type_question_id){
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->select('order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getMaxStepOfLearning($type_question_id){
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->select('order_lesson')->orderBy('order_lesson', 'desc')->get()->first();
    }

    public function getPreLearningId($type_question_id, $current_order_lesson) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->where('order_lesson', '<', $current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getNextLearningId($type_question_id, $current_order_lesson) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->where('order_lesson', '>',$current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function createNewLearningTypeQuestion ($level_user_id, $type_question_id, $title, $order_lesson, $view_layout, $icon, $content_section, $left_content, $right_content, $content_answer_quiz, $content_highlight, $total_questions, $admin_responsibility) {
        if ($this->where('type_question_id', $type_question_id)->where('title', $title)->exists()) {
            // level found
            return 'fail-title';
        }
        else if ($this->where('type_question_id', $type_question_id)->where('order_lesson', $order_lesson)->exists()) {
            return 'fail-step';
        }
        else {
            $new_learning_type_question = new ReadingLearningTypeQuestion();
            $new_learning_type_question->level_user_id = $level_user_id;
            $new_learning_type_question->type_question_id = $type_question_id;
            $new_learning_type_question->title = $title;
            $new_learning_type_question->order_lesson = $order_lesson;
            $new_learning_type_question->view_layout = $view_layout;
            $new_learning_type_question->left_content = $left_content;
            $new_learning_type_question->right_content = $right_content;
            $new_learning_type_question->icon = $icon;
            $new_learning_type_question->content_section = $content_section;
            $new_learning_type_question->content_answer_quiz = $content_answer_quiz;
            $new_learning_type_question->content_highlight = $content_highlight;
            $new_learning_type_question->total_questions = $total_questions;
            $new_learning_type_question->admin_responsibility = $admin_responsibility;
            $new_learning_type_question->save();
            return $new_learning_type_question->id;
        }
    }
}
