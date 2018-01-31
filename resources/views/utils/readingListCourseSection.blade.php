<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 19/11/2017
 * Time: 11:00 AM
 */
$readingLessonService = new App\Services\ReadingLessonService();
$all_level_lessons = $readingLevelLessonService->getAllLevelLesson();
?>
<h5 class="title-list-course-section">
    <a href="{{url('/reading/' . $current_level_lesson->id . '-level')}}">
        Dashboard
    </a>
</h5>
<div class="top-menu">
    <h3 class="level-lesson-current">
        <a href="{{url('/reading/'. $current_level_lesson->id . '-level/')}}">
            {!! $current_level_lesson->level !!}
        </a>
    </h3>
    <div class="dropdown list-level-lesson">
                    <span class="fa-stack fa-lg select-level-lesson" data-toggle="dropdown">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-caret-right fa-stack-1x icon-inner-custom icon-hide"></i>
                        <i class="fa fa-caret-down fa-stack-1x icon-inner-custom icon-show"></i>
                    </span>
        <div class="dropdown-menu">
            @foreach($all_level_lessons as $level_lesson)
                <a href="{{url('/reading/'. $level_lesson->id . '-level/')}}" class="dropdown-item @if($level_lesson->id == $current_level_lesson->id) disabled @endif">{!! $level_lesson->level !!}</a>
            @endforeach
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Select Level</h6>
        </div>
    </div>
</div>
<div class="list-course-area">
    <div class="title-list-course" data-toggle="collapse" data-target="#allCourse" aria-expanded="true">
        <i class="fa fa-caret-right icon-hide-course" aria-hidden="true"></i>
        <i class="fa fa-caret-down icon-show-course" aria-hidden="true"></i>
        <h5 class="title-course-collage">
            Courses
        </h5>
    </div>
    <div id="allCourse" class="collapse show">
        <div class="list-course" id="listCourse">
            {{--Show Introductions--}}
            @if(sizeof($all_introductions) > 0)
                <div class="list-introduction-area item-course {!! ($type_lesson_id == -$level_lesson_id) ? 'li-selected' : '' !!}">
                    <h6 class="title-menu">
                        <a href="{{url('/reading/' . $current_level_lesson->id . '-level/readingOverviewDetail/' . -$level_lesson_id . '-type/0-introduction')}}">
                            Introduction
                        </a>
                    </h6>
                </div>
            @endif

            {{--Show Lesson--}}
            <div class="list-lesson-area item-course {!! $level_lesson_id == 3 ? 'hidden' : '' !!}">
                <h6 class="title-menu" data-toggle="collapse" data-target="#lessons" aria-expanded="true">
                    <a href="#">Type Lessons</a>
                </h6>
                <ul class="collapse @if($type_lesson_id < config('constants.type_lesson.mix_test')) show type-current @endif" id="lessons">
                    @foreach($all_type_questions as $key_type_question => $type_question)
                        <?php
                        $mini_tests = $readingLessonService->getLessonsByTypeQuestionId(Config('constants.type_lesson.mini_test'), $type_question->id);
                        $learnings = $readingLearningTypeQuestionService->getLearningOfTypeQuestion($type_question->id);
                        $practices = $readingLessonService->getLessonsByTypeQuestionId(Config('constants.type_lesson.practice'), $type_question->id);
                        ?>
                        @if(sizeof($learnings) > 0 || sizeof($practices) > 0 || sizeof($mini_tests) > 0)
                            <li class="li-type-question {!! ($type_lesson_id >= 0 && $type_lesson_id < 3 && $type_question_id == $type_question->id) ? 'li-selected' : '' !!}">
                                <a href="{{url('/reading/' . $current_level_lesson->id . '-level/readingOverviewDetail/' . config('constants.type_lesson.practice') . '-type/' . $type_question->id . '-type-question')}}">
                                    {!! $key_type_question + 1 !!}. {!! $type_question->name !!}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{--Show Mix Test--}}
            @if(sizeof($mix_tests) > 0)
                <div class="list-mix-test-area item-course {!! ($type_lesson_id == config('constants.type_lesson.mix_test')) ? 'li-selected' : '' !!}">
                    <h6 class="title-menu">
                        <a href="{{url('/reading/' . $current_level_lesson->id . '-level/readingOverviewDetail/' . config('constants.type_lesson.mix_test') . '-type/0-mix-test')}}">
                            Mix Test
                        </a>
                    </h6>
                </div>
            @endif

            {{--Show Full Test--}}
            @if(sizeof($full_tests) > 0)
                <div class="list-full-test-area item-course {!! ($type_lesson_id == config('constants.type_lesson.full_test')) ? 'li-selected' : '' !!}">
                    <h6 class="title-menu">
                        <a href="{{url('/reading/' . $current_level_lesson->id . '-level/readingOverviewDetail/' . config('constants.type_lesson.full_test') . '-type/0-full-test')}}">
                            Full Test
                        </a>
                    </h6>
                </div>
            @endif
        </div>
    </div>
</div>
