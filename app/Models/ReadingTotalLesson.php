<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReadingTotalLesson extends Model
{
    protected $table = 'reading_total_lessons';

    protected $fillable = ['level_lesson_id', 'type_lesson_id', 'type_question_id', 'total_lessons'];

    public $timestamps = true;

    public function updateNewTotalLessons($level_lesson_id, $type_lesson_id, $type_question_id, $total_lessons) {
        if ($this->where('level_lesson_id', $level_lesson_id)->where('type_lesson_id', $type_lesson_id)->where('type_question_id', $type_question_id)->exists()) {
            // Record found
            $this->where('level_lesson_id', $level_lesson_id)->where('type_lesson_id', $type_lesson_id)->where('type_question_id', $type_question_id)->update(['total_lessons' => $total_lessons, 'updated_at' => Carbon::now()]);
            return 'update-success';
        }
        else {
            $new_total_lessons = new ReadingTotalLesson();
            $new_total_lessons->level_lesson_id = $level_lesson_id;
            $new_total_lessons->type_lesson_id = $type_lesson_id;
            $new_total_lessons->type_question_id = $type_question_id;
            $new_total_lessons->total_lessons = $total_lessons;
            $new_total_lessons->save();
            return 'new-success';
        }
    }

    public function getTotalLessonByLevelLesson($level_lesson_id) {
        return $this->where('level_lesson_id', $level_lesson_id)->sum('total_lessons');
    }

    public function updateNewTotalTypeLessonsInserted($level_lesson_id, $type_lesson_id, $type_question_id) {
        $query_total_lessons = $this->where('level_lesson_id', $level_lesson_id)->where('type_lesson_id', $type_lesson_id)->where('type_question_id', $type_question_id)->select('total_lessons')->get()->first();
        if ($query_total_lessons != null) {
            // Record found
            $total_lessons = $query_total_lessons->total_lessons + 1;
            $this->where('level_lesson_id', $level_lesson_id)->where('type_lesson_id', $type_lesson_id)->where('type_question_id', $type_question_id)->update(['total_lessons' => $total_lessons, 'updated_at' => Carbon::now()]);
            return $total_lessons;
        }
        else {
            $new_total_lessons = new ReadingTotalLesson();
            $new_total_lessons->level_lesson_id = $level_lesson_id;
            $new_total_lessons->type_lesson_id = $type_lesson_id;
            $new_total_lessons->type_question_id = $type_question_id;
            $new_total_lessons->total_lessons = 1;
            $new_total_lessons->save();
            return $new_total_lessons->total_lessons;
        }
    }
}
