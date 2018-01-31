<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReadingMiniTestLesson extends Model
{
    protected $table = 'reading_mini_test_lessons';

    protected $fillable = ['title', 'level_user_id', 'content_lesson', 'content_highlight', 'image_feature', 'content_quiz', 'content_answer_quiz', 'total_questions', 'order_lesson', 'type_question_id', 'limit_time', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function questionLessons()
    {
        return $this->hasMany('App\Models\ReadingQuestionLesson', 'lesson_id');
    }

    public function typeQuestion()
    {
        return $this->belongsTo('App\Models\ReadingTypeQuestion', 'type_question_id');
    }

    public function levelUser()
    {
        return $this->belongsTo('App\Models\ReadingLevelUser', 'level_user_id');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'admin_responsibility');
    }

    public function getTheLastLessonId() {
        return $this->select('id')->orderBy('id', 'desc')->first();
    }

    public function getTotalQuestionOfMiniTestLesson($lesson_id) {
        return $this->where('id', $lesson_id)->select('total_questions')->get()->first();
    }

    public function getCurrentStepOfMiniTest($lesson_id) {
        return $this->where('id', $lesson_id)->select('order_lesson')->get()->first();
    }

    public function addNewMiniTest($title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $type_question_id, $limit_time, $admin_responsibility) {
        if ($this->where('type_question_id', $type_question_id)->where('order_lesson', $order_lesson)->exists()) {
            return 'fail-order';
        }
        else {
            $new_mini_test = new ReadingMiniTestLesson();
            $new_mini_test->title = $title;
            $new_mini_test->level_user_id = $level_user_id;
            $new_mini_test->content_lesson = $content_lesson;
            $new_mini_test->content_highlight = $content_highlight;
            $new_mini_test->image_feature = $image_feature;
            $new_mini_test->content_quiz = $content_quiz;
            $new_mini_test->content_answer_quiz = $content_answer_quiz;
            $new_mini_test->total_questions = $total_questions;
            $new_mini_test->order_lesson = $order_lesson;
            $new_mini_test->type_question_id = $type_question_id;
            $new_mini_test->limit_time = $limit_time;
            $new_mini_test->admin_responsibility = $admin_responsibility;
            $new_mini_test->save();
            return $new_mini_test->id;
        }
    }

    public function getAllOrderMiniTestByTypeQuestionId($type_question_id) {
        return $this->where('type_question_id', $type_question_id)->where('status', 1)->orderBy('order_lesson','asc')->select('order_lesson')->get()->all();
    }

    public function deleteMiniTest($lesson_id) {
        return $this->where('id', $lesson_id)->update(['status' => 0, 'updated_at' => Carbon::now()]);
    }

    public function updateTitleMiniTest($lesson_id, $title, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('title', $title)->exists()) {
            return 'title-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['title' => $title, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function updateLimitTimeMiniTest($lesson_id, $limit_time, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('limit_time', $limit_time)->exists()) {
            return 'limit-time-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['limit_time' => $limit_time, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function getDetailMiniTestForAdminEdit($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'content_lesson', 'content_highlight', 'content_quiz', 'content_answer_quiz', 'type_question_id')->get()->first();
    }

    public function updateContentMiniTest($lesson_id, $content_lesson, $content_highlight, $admin_responsibility) {
        $this->where('id', $lesson_id)->update(['content_lesson' => $content_lesson, 'content_highlight' => $content_highlight, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
        return 'update-success';
    }

    public function updateLevelUserMiniTest($lesson_id, $level_user_id, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('level_user_id', $level_user_id)->exists()) {
            return 'level-user-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['level_user_id' => $level_user_id, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function updateQuizMiniTest($lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions, $admin_responsibility) {
        $this->where('id', $lesson_id)->update(['content_highlight' => $content_highlight, 'content_quiz' => $content_quiz, 'content_answer_quiz' => $content_answer_quiz, 'total_questions' => $total_questions, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
        return 'update-success';
    }

    public function updateBasicInfoMiniTest($lesson_id, $type_question_id, $order_lesson, $admin_responsibility) {
        if ($this->where('type_question_id', $type_question_id)->where('order_lesson', $order_lesson)->where('status', 1)->exists()) {
            return 'order-fail';
        }
        else {
            $this->where('id', $lesson_id)->update(['type_question_id' => $type_question_id, 'order_lesson' => $order_lesson, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function getTypeQuestionOfMiniTest($lesson_id) {
        return $this->where('id', $lesson_id)->select('type_question_id')->get()->first();
    }

    public function getAllMiniTest() {
        return $this->where('status',1)->orderBy('updated_at','desc')->select('id', 'title', 'level_user_id', 'image_feature', 'order_lesson', 'type_question_id', 'limit_time', 'admin_responsibility')->get()->all();
    }

    public function getMiniTestByTypeQuestionId($type_question_id) {
        return $this->where('status',1)->where('type_question_id', $type_question_id)->orderBy('order_lesson','asc')->select('id', 'title', 'level_user_id', 'image_feature', 'order_lesson', 'total_questions', 'limit_time')->get()->all();
    }

    public function getTotalMiniTestByTypeQuestionId($type_question_id) {
        return $this->where('status',1)->where('type_question_id', $type_question_id)->count();
    }

    public function checkVipMiniTestLesson($lesson_id) {
        return $this->where('id', $lesson_id)->select('level_user_id')->get()->first();
    }

    public function getDetailMiniTestForClientTest($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'title', 'content_lesson', 'content_quiz', 'total_questions', 'order_lesson', 'type_question_id', 'limit_time')->get()->first();
    }

    public function getDetailMiniTestForClientSolution($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'title', 'content_highlight', 'content_answer_quiz', 'total_questions', 'order_lesson', 'type_question_id')->get()->first();
    }

    public function getDetailMiniTestForClientMiddleware($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'level_user_id', 'type_question_id')->get()->first();
    }

    public function getMinStepMiniLesson($type_question_id){
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->select('order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getMaxStepMiniLesson($type_question_id){
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->select('order_lesson')->orderBy('order_lesson', 'desc')->get()->first();
    }

    public function getPreMiniTestId($type_question_id, $current_order_lesson) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->where('order_lesson', '<',$current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getNextMiniTestId($type_question_id, $current_order_lesson) {
        return $this->where('status', 1)->where('type_question_id', $type_question_id)->where('order_lesson', '>',$current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getLessonResume($lesson_id) {
        return $this->where('id', $lesson_id)->select('id', 'type_question_id', 'order_lesson', 'total_questions')->get()->first();
    }
}
