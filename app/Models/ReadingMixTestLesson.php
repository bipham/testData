<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReadingMixTestLesson extends Model
{
    protected $table = 'reading_mix_test_lessons';

    protected $fillable = ['title', 'level_lesson_id', 'level_user_id', 'content_lesson', 'content_highlight', 'image_feature', 'content_quiz', 'content_answer_quiz', 'total_questions', 'order_lesson', 'limit_time', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function levelLesson()
    {
        return $this->belongsTo('App\Models\ReadingLevelLesson', 'level_lesson_id');
    }

    public function questionLessons()
    {
        return $this->hasMany('App\Models\ReadingQuestionLesson', 'lesson_id');
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

    public function updateQuizMixTest($lesson_id, $content_highlight, $content_quiz, $content_answer_quiz, $total_questions, $admin_responsibility) {
        $this->where('id', $lesson_id)->update(['content_highlight' => $content_highlight, 'content_quiz' => $content_quiz, 'content_answer_quiz' => $content_answer_quiz, 'total_questions' => $total_questions, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
        return 'update-success';
    }

    public function deleteMixTest($lesson_id) {
        return $this->where('id', $lesson_id)->update(['status' => 0, 'updated_at' => Carbon::now()]);
    }

    public function getTotalMixTestByLevelLesson($level_lesson_id) {
        return $this->where('status',1)->where('level_lesson_id', $level_lesson_id)->count();
    }

    public function updateBasicInfoMixTest($lesson_id, $level_lesson_id, $order_lesson, $admin_responsibility) {
        if ($this->where('level_lesson_id', $level_lesson_id)->where('order_lesson', $order_lesson)->where('status', 1)->exists()) {
            return 'order-fail';
        }
        else {
            $this->where('id', $lesson_id)->update(['level_lesson_id' => $level_lesson_id, 'order_lesson' => $order_lesson, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function getDetailMixTestForAdminEdit($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'content_lesson', 'content_highlight', 'content_quiz', 'content_answer_quiz', 'level_lesson_id')->get()->first();
    }

    public function updateLevelUserMixTest($lesson_id, $level_user_id, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('level_user_id', $level_user_id)->exists()) {
            return 'level-user-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['level_user_id' => $level_user_id, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function updateLimitTimeMixTest($lesson_id, $limit_time, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('limit_time', $limit_time)->exists()) {
            return 'limit-time-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['limit_time' => $limit_time, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }


    public function addNewMixTest($level_lesson_id, $title, $level_user_id, $content_lesson, $content_highlight, $image_feature, $content_quiz, $content_answer_quiz, $total_questions, $order_lesson, $limit_time, $admin_responsibility) {
        if ($this->where('level_lesson_id', $level_lesson_id)->where('order_lesson', $order_lesson)->exists()) {
            return 'fail-order';
        }
        else {
            $new_mix_test = new ReadingMixTestLesson();
            $new_mix_test->level_lesson_id = $level_lesson_id;
            $new_mix_test->title = $title;
            $new_mix_test->level_user_id = $level_user_id;
            $new_mix_test->content_lesson = $content_lesson;
            $new_mix_test->content_highlight = $content_highlight;
            $new_mix_test->image_feature = $image_feature;
            $new_mix_test->content_quiz = $content_quiz;
            $new_mix_test->content_answer_quiz = $content_answer_quiz;
            $new_mix_test->total_questions = $total_questions;
            $new_mix_test->order_lesson = $order_lesson;
            $new_mix_test->limit_time = $limit_time;
            $new_mix_test->admin_responsibility = $admin_responsibility;
            $new_mix_test->save();
            return $new_mix_test->id;
        }
    }

    public function getAllOrderMixTestByLevelLessonId($level_lesson_id) {
        return $this->where('level_lesson_id', $level_lesson_id)->where('status', 1)->orderBy('order_lesson','asc')->select('order_lesson')->get()->all();
    }

    public function updateTitleMixTest($lesson_id, $title, $admin_responsibility) {
        if ($this->where('id', $lesson_id)->where('title', $title)->exists()) {
            return 'title-not-change';
        }
        else {
            $this->where('id', $lesson_id)->update(['title' => $title, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
    }

    public function getAllMixTestLessons($level_lesson_id) {
        return $this->where('status', 1)->where('level_lesson_id', $level_lesson_id)->orderBy('order_lesson', 'asc')->select('id', 'title', 'level_user_id', 'order_lesson', 'limit_time', 'total_questions')->get()->all();
    }

    public function getDetailMixTestForClientTest($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'title', 'level_lesson_id', 'content_lesson', 'content_quiz', 'total_questions', 'order_lesson', 'limit_time')->get()->first();
    }

    public function getTotalQuestionOfMixTestLesson($lesson_id) {
        return $this->where('id', $lesson_id)->select('total_questions')->get()->first();
    }

    public function getCurrentStepOfMixTest($lesson_id) {
        return $this->where('id', $lesson_id)->select('order_lesson')->get()->first();
    }

    public function getDetailMixTestForClientSolution($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'title', 'content_highlight', 'level_lesson_id', 'content_answer_quiz', 'order_lesson', 'total_questions')->get()->first();
    }

    public function getDetailMixTestForClientMiddleware($lesson_id) {
        return $this->where('status', 1)->where('id', $lesson_id)->select('id', 'level_lesson_id', 'level_user_id')->get()->first();
    }

    public function updateContentMixTest($lesson_id, $content_lesson, $content_highlight, $admin_responsibility) {
        $this->where('id', $lesson_id)->update(['content_lesson' => $content_lesson, 'content_highlight' => $content_highlight, 'admin_responsibility' => $admin_responsibility, 'updated_at' => Carbon::now()]);
        return 'update-success';
    }

    public function getMinStepMixTest($level_lesson_id){
        return $this->where('status', 1)->where('level_lesson_id', $level_lesson_id)->select('order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getMaxStepMixTest($level_lesson_id){
        return $this->where('status', 1)->where('level_lesson_id', $level_lesson_id)->select('order_lesson')->orderBy('order_lesson', 'desc')->get()->first();
    }

    public function getPreMixTestId($level_lesson_id, $current_order_lesson) {
        return $this->where('status', 1)->where('level_lesson_id', $level_lesson_id)->where('order_lesson', '<',$current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getNextMixTestId($level_lesson_id, $current_order_lesson) {
        return $this->where('status', 1)->where('level_lesson_id', $level_lesson_id)->where('order_lesson', '>',$current_order_lesson)->select('id', 'order_lesson')->orderBy('order_lesson', 'asc')->get()->first();
    }

    public function getAllMixTest() {
        return $this->where('status',1)->orderBy('updated_at','desc')->select('id', 'title', 'level_user_id', 'image_feature', 'order_lesson', 'level_lesson_id', 'limit_time', 'admin_responsibility')->get()->all();
    }

    public function getLessonResume($lesson_id) {
        return $this->where('id', $lesson_id)->select('id', 'level_lesson_id', 'order_lesson', 'total_questions')->get()->first();
    }
}
