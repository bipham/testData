<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 17/11/2017
 * Time: 3:32 PM
 */
$link_test_url = ($type_lesson_id > 0) ? 'readingLesson' : 'readingViewLearning';
//dd($lesson->order_lesson);
?>
<a href="{{url(($lesson->order_lesson > $min_step) ? '/reading/' . $level_lesson_id . '-level/'. $link_test_url . '/' . $type_lesson_id . '/' . $pre_lesson_id . '-lesson' : '#')}}" class="pull-left">
    <button type="button" class="btn btn-tool-sidebar btn-prev-lesson btn-custom pull-left" {!! ($lesson->order_lesson == $min_step) ? 'disabled' : '' !!}>
        Back
    </button>
</a>
@if(Route::current()->getName() == 'readingViewSolutionLesson' || Route::current()->getName() == 'readingViewResultLesson')
    <div class="reading-solution-button-test pull-left" data-type-lesson-id="{!! $type_lesson_id !!}">
        @include('utils.readingButtonSolutionTest')
        @if(Route::current()->getName() == 'readingViewResultLesson')
            <a href="{{url((sizeof($correct_answer) < ($total_questions/2)) ? '/reading/' . $level_lesson_id . '-level/'. $link_test_url . '/' . $type_lesson_id . '/' . $lesson_id_current . '-lesson' : '#')}}">
                <button type="button" class="btn btn-warning btn-tool-sidebar btn-footer-lesson btn-test-again btn-custom" {!! (sizeof($correct_answer) < ($total_questions/2)) ? '' : 'hidden' !!}>
                    Test Again
                </button>
            </a>
        @endif
    </div>
@elseif(Route::current()->getName() == 'readingLesson' && $type_lesson_id == 4)
    <div class="reading-solution-button-test pull-left">
        <div class="btn-full-test-area hidden">
            @include('utils.readingButtonViewFullTest')
        </div>
    </div>
@endif
<a href="{{url((($type_lesson_id == 0 && $lesson->order_lesson < $max_step && $type_question_id_current < 0) || ($lesson->order_lesson < $your_max_step && $your_max_step <= $max_step)) ? '/reading/' . $level_lesson_id . '-level/'. $link_test_url . '/' . $type_lesson_id . '/' . $next_lesson_id . '-lesson' : '#')}}" class="pull-right">
    <button type="button" class="btn btn-tool-sidebar btn-next-lesson btn-custom pull-right" {!! (($type_lesson_id == 0 && $lesson->order_lesson < $max_step && $type_question_id_current < 0) || ($lesson->order_lesson < $your_max_step && $your_max_step <= $max_step)) ? '' : 'disabled' !!}>
        Next
    </button>
</a>

