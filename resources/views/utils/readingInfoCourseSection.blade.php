<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 19/11/2017
 * Time: 11:11 AM
 */
$readingStatusLearningOfUserService = new App\Services\ReadingStatusLearningOfUserService();
$readingLessonService = new App\Services\ReadingLessonService();
$readingResultService = new App\Services\ReadingResultService();
?>
<div class="info-course-detail">
    <h4 class="title-section-info">
        Get Started
    </h4>
    <div class="row banner-overview">
        <div class="col-md-2 show-img-overview img-overview-outer img-responsive-outer">
            <div class="img-thumbnail-inner">
                <div class="inner-responsive-content">
                    <img class="img-responsive-auto img-overview" src="{{url('/imgs/original/logo.jpg')}}" alt="Logo">
                    <h6 class="title-level">
                        {!! $current_level_lesson->level !!}
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-10 show-info-basic-course">
            <div class="banner-area">
                <h4 class="title-info-basic-course">
                    @if(Route::current()->getName() == 'readingOverview')
                        Level {!! $current_level_lesson->level !!}
                    @else
                        {!! $type_question_name !!}
                    @endif
                </h4>
                @if($lesson_resume == null)
                    <div class="show-short-introduction">
                        <h6 class="guide-to-start">
                            Please select a lesson to start ...
                        </h6>
                    </div>
                @else
                    <div class="resume-area">
                        <?php
                            if ($lesson_resume->type_lesson_id == 0) {
                                $link_type_view_lesson = 'readingViewLearning';
                            }
                            else {
                                $link_type_view_lesson = 'readingLesson';
                            }
                        ?>
                        <a href="{{url('/reading/' . $level_lesson_id . '-level/' . $link_type_view_lesson . '/' . $lesson_resume->type_lesson_id . '/' . $lesson_resume->lesson_resume_id)}}" class="resume-link">
                            <button type="button" class="btn btn-resume-course">
                                Resume
                            </button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row stat-overview">
            <div class="col-md-9 detail-include-component img-responsive-outer">
                @if(Route::current()->getName() == 'readingOverview')
                    <div class="img-thumbnail-inner">
                        <div class="inner-responsive-content">
                            @if(sizeof($all_introductions) > 0)
                                <span class="overview-each-type">
                                    <h4 class="number-total">
                                        {!! sizeof($all_introductions) !!}
                                    </h4>
                                    <h5 class="title-type">
                                        Introductions
                                    </h5>
                                </span>
                            @endif

                            @if(sizeof($all_type_questions) > 0)
                                <span class="overview-each-type">
                            <h4 class="number-total">
                                {!! sizeof($all_type_questions) !!}
                            </h4>
                            <h5 class="title-type">
                                Type questions
                            </h5>
                        </span>
                            @endif

                            @if(sizeof($mix_tests) > 0)
                                <span class="overview-each-type">
                            <h4 class="number-total">
                                {!! sizeof($mix_tests) !!}
                            </h4>
                            <h5 class="title-type">
                                Mix tests
                            </h5>
                        </span>
                            @endif

                            @if(sizeof($full_tests) > 0)
                                <span class="overview-each-type">
                            <h4 class="number-total">
                                {!! sizeof($full_tests) !!}
                            </h4>
                            <h5 class="title-type">
                                Full tests
                            </h5>
                        </span>
                            @endif
                        </div>
                    </div>
                @else
                    @if($type_lesson_id < 0)
                        <div class="img-thumbnail-inner">
                            <div class="inner-responsive-content">
                                @if(sizeof($all_introductions) > 0)
                                    <span class="overview-each-type">
                                        <h4 class="number-total">
                                            {!! sizeof($all_introductions) !!}
                                        </h4>
                                        <h5 class="title-type">
                                            Introductions
                                        </h5>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @elseif($type_lesson_id >= 0 && $type_lesson_id < config('constants.type_lesson.mix_test'))
                        <div class="img-thumbnail-inner">
                            <div class="inner-responsive-content">
                                @if(sizeof($all_learnings) > 0)
                                    <span class="overview-each-type">
                                <h4 class="number-total">
                                    {!! sizeof($all_learnings) !!}
                                </h4>
                                <h5 class="title-type">
                                    Learnings
                                </h5>
                            </span>
                                @endif

                                @if(sizeof($all_practices) > 0)
                                    <span class="overview-each-type">
                                <h4 class="number-total">
                                    {!! sizeof($all_practices) !!}
                                </h4>
                                <h5 class="title-type">
                                    Practices
                                </h5>
                            </span>
                                @endif

                                @if(sizeof($all_mini_tests) > 0)
                                    <span class="overview-each-type">
                                <h4 class="number-total">
                                    {!! sizeof($all_mini_tests) !!}
                                </h4>
                                <h5 class="title-type">
                                    Mini tests
                                </h5>
                            </span>
                                @endif
                            </div>
                        </div>
                    @elseif($type_lesson_id == config('constants.type_lesson.mix_test'))
                        <div class="img-thumbnail-inner">
                            <div class="inner-responsive-content">
                                @if(sizeof($mix_tests) > 0)
                                    <span class="overview-each-type">
                            <h4 class="number-total">
                                {!! sizeof($mix_tests) !!}
                            </h4>
                            <h5 class="title-type">
                                Mix tests
                            </h5>
                        </span>
                                @endif
                            </div>
                        </div>
                    @elseif($type_lesson_id == config('constants.type_lesson.full_test'))
                        <div class="img-thumbnail-inner">
                            <div class="inner-responsive-content">
                                @if(sizeof($full_tests) > 0)
                                    <span class="overview-each-type">
                            <h4 class="number-total">
                                {!! sizeof($full_tests) !!}
                            </h4>
                            <h5 class="title-type">
                                Full tests
                            </h5>
                        </span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-3 col-upgrade">
                @if(Auth::user()->level_user_id < 3)
                    <span class="overview-each-type upgrade-banner">
                            <button type="button" class="btn btn-primary btn-upgrade">
                                <a href="#">
                                    Upgrade Now
                                </a>
                            </button>
                            <div class="guide-upgrade">
                                Upgrade to unlock all lessons ....
                            </div>
                        </span>
                @endif
            </div>
        </div>
        @if(Route::current()->getName() == 'readingOverviewDetail')
            <div class="progress-area">
                <div class="title-progress-area">
                    <h6 class="title-progress">
                        Progress
                    </h6>
                </div>
                <div class="progress-content-area">
                    <ul class="list-progress">
                        @if($type_lesson_id < 0)
                            @if(sizeof($all_introductions) > 0)
                                <li data-toggle="collapse" data-target="#introductions" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-pencil icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Introductions
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="introductions">
                                    @foreach($all_introductions as $key_introduction => $introduction)
                                        <?php
                                        $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.learning'), $introduction->id);
                                        ?>
                                        <li class="item-lesson">
                                                <div class="pull-left current-lesson inline-class">
                                                    <i class="fa fa-angle-right icon-current-custom hidden" aria-hidden="true"></i>
                                                </div>
                                                <div class="icon-status-lesson inline-class">
                                                    <div class="border-left-custom {!! ($key_introduction == 0) ? 'first-border' : '' !!}">

                                                    </div>
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <div class="title-item-lesson inline-class">
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingViewLearning/' . config('constants.type_lesson.learning') . '-introduction/' . $introduction->id . '-introduction')}}">
                                                        {!! $introduction->title !!}
                                                    </a>
                                                </div>
                                                <div class="pull-right status-lesson inline-class">
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                        {!! $highest_score->highest_correct !!}/{!! $introduction->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingViewLearning/' . config('constants.type_lesson.learning') . '-introduction/' . $introduction->id . '-introduction')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </li>
                                    @endforeach
                                </ul>
                            @endif
                        @elseif($type_lesson_id >= 0 && $type_lesson_id < config('constants.type_lesson.mix_test'))
                            {{--Show learning:--}}
                            @if(sizeof($all_learnings) > 0)
                                <?php
                                $learning_highest_step = $readingStatusLearningOfUserService->getHighestStepLessonService($current_level_lesson->id, $type_question_id, config('constants.type_lesson.learning'));
                                ?>
                                <li data-toggle="collapse" data-target="#learning" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-leanpub icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Learnings
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="learning">
                                    @foreach($all_learnings as $key_learning => $learning)
                                        <?php
                                        $check_vip = $readingLessonService->checkVipLesson(config('constants.type_lesson.learning'), $learning->id);
                                        $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.learning'), $learning->id);
                                        ?>
                                        <li class="item-lesson">
                                            <div class="pull-left current-lesson inline-class">
                                                <i class="fa fa-angle-right icon-current-custom {!! ($learning_highest_step == $learning->order_lesson) ? '' : 'not-show' !!}" aria-hidden="true"></i>
                                            </div>
                                            <div class="icon-status-lesson inline-class">
                                                <div class="border-left-custom {!! ($key_learning == 0) ? 'first-border' : '' !!}">

                                                </div>
                                                @if($check_vip)
                                                    <div class="status-custom-area">
                                                        <div class="pro-lesson">
                                                            PRO
                                                        </div>
                                                    </div>
                                                @elseif($learning->order_lesson > $learning_highest_step)
                                                    <div class="status-custom-area item-lock">
                                                        <i class="fa fa-lock icon-status-custom icon-item-lock" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title-item-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="inline-class pro-title-lesson">
                                                        PRO
                                                    </div>
                                                    {!! $learning->title !!}
                                                @elseif($learning->order_lesson > $learning_highest_step)
                                                    {!! $learning->title !!}
                                                @else
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingViewLearning/' . config('constants.type_lesson.learning') . '-learning/' . $learning->id . '-learning')}}">
                                                        {!! $learning->title !!}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="pull-right status-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-upgrade">
                                                            <a href="#">
                                                                Upgrade Now
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @elseif($learning->order_lesson > $learning_highest_step)
                                                    <div class="pull-right go-to-item locked-item">
                                                        Locked
                                                    </div>
                                                @else
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                            {!! $highest_score->highest_correct !!}/{!! $learning->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingViewLearning/' . config('constants.type_lesson.learning') . '-learning/' . $learning->id . '-learning')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{--Show practice:--}}
                            @if(sizeof($all_practices) > 0)
                                <?php
                                $practice_highest_step = $readingStatusLearningOfUserService->getHighestStepLessonService($current_level_lesson->id, $type_question_id, config('constants.type_lesson.practice'));
                                ?>
                                <li data-toggle="collapse" data-target="#practice" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-pencil icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Practices
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="practice">
                                    @foreach($all_practices as $key_practice => $practice)
                                        <?php
                                        $check_vip = $readingLessonService->checkVipLesson(config('constants.type_lesson.practice'), $practice->id);
                                        $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.practice'), $practice->id);
                                        ?>
                                        <li class="item-lesson">
                                            <div class="pull-left current-lesson inline-class">
                                                <i class="fa fa-angle-right icon-current-custom {!! ($practice_highest_step == $practice->order_lesson) ? '' : 'not-show' !!}" aria-hidden="true"></i>
                                            </div>
                                            <div class="icon-status-lesson inline-class">
                                                <div class="border-left-custom {!! ($key_practice == 0) ? 'first-border' : '' !!}">

                                                </div>
                                                @if($check_vip)
                                                    <div class="status-custom-area">
                                                        <div class="pro-lesson">
                                                            PRO
                                                        </div>
                                                    </div>
                                                @elseif($practice->order_lesson > $practice_highest_step)
                                                    <div class="status-custom-area item-lock">
                                                        <i class="fa fa-lock icon-status-custom icon-item-lock" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title-item-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="inline-class pro-title-lesson">
                                                        PRO
                                                    </div>
                                                    {!! $practice->title !!}
                                                @elseif($practice->order_lesson > $practice_highest_step)
                                                    {!! $practice->title !!}
                                                @else
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.practice') . '-practice/' . $practice->id . '-practice')}}">
                                                        {!! $practice->title !!}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="pull-right status-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-upgrade">
                                                            <a href="#">
                                                                Upgrade Now
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @elseif($practice->order_lesson > $practice_highest_step)
                                                    <div class="pull-right go-to-item locked-item">
                                                        Locked
                                                    </div>
                                                @else
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                            {!! $highest_score->highest_correct !!}/{!! $practice->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.practice') . '-practice/' . $practice->id . '-practice')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{--Show Mini Test --}}
                            @if(sizeof($all_mini_tests) > 0)
                                <?php
                                $mini_test_highest_step = $readingStatusLearningOfUserService->getHighestStepLessonService($current_level_lesson->id, $type_question_id, config('constants.type_lesson.mini_test'));
                                ?>
                                <li data-toggle="collapse" data-target="#minitest" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-clock-o icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Mini Tests
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="minitest">
                                    @foreach($all_mini_tests as $key_mini_test => $mini_test)
                                        <?php
                                        $check_vip = $readingLessonService->checkVipLesson(config('constants.type_lesson.mini_test'), $mini_test->id);
                                        $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.mini_test'), $mini_test->id);
                                        ?>
                                        <li class="item-lesson">
                                            <div class="pull-left current-lesson inline-class">
                                                <i class="fa fa-angle-right icon-current-custom {!! ($mini_test_highest_step == $mini_test->order_lesson) ? '' : 'not-show' !!}" aria-hidden="true"></i>
                                            </div>
                                            <div class="icon-status-lesson inline-class">
                                                <div class="border-left-custom {!! ($key_mini_test == 0) ? 'first-border' : '' !!}">

                                                </div>
                                                @if($check_vip)
                                                    <div class="status-custom-area">
                                                        <div class="pro-lesson">
                                                            PRO
                                                        </div>
                                                    </div>
                                                @elseif($mini_test->order_lesson > $mini_test_highest_step)
                                                    <div class="status-custom-area item-lock">
                                                        <i class="fa fa-lock icon-status-custom icon-item-lock" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title-item-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="inline-class pro-title-lesson">
                                                        PRO
                                                    </div>
                                                    {!! $mini_test->title !!}
                                                @elseif($mini_test->order_lesson > $mini_test_highest_step)
                                                    {!! $mini_test->title !!}
                                                @else
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.mini_test') . '-mini_test/' . $mini_test->id . '-mini_test')}}">
                                                        {!! $mini_test->title !!}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="pull-right status-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-upgrade">
                                                            <a href="#">
                                                                Upgrade Now
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @elseif($mini_test->order_lesson > $mini_test_highest_step)
                                                    <div class="pull-right go-to-item locked-item">
                                                        Locked
                                                    </div>
                                                @else
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                            {!! $highest_score->highest_correct !!}/{!! $mini_test->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.mini_test') . '-mini_test/' . $mini_test->id . '-mini_test')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{--Show Mix Test --}}
                        @elseif($type_lesson_id == config('constants.type_lesson.mix_test'))
                            @if(sizeof($mix_tests) > 0)
                                <li data-toggle="collapse" data-target="#mix_test" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-pencil icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Mix Tests
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="mix_test">
                                    <?php
                                        $mix_test_highest_step = $readingStatusLearningOfUserService->getHighestStepLessonService($current_level_lesson->id, 0, config('constants.type_lesson.mix_test'));
                                    ?>
                                    @foreach($mix_tests as $key_mix_test => $mix_test)
                                            <?php
                                            $check_vip = $readingLessonService->checkVipLesson(config('constants.type_lesson.mix_test'), $mix_test->id);
                                            $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.mix_test'), $mix_test->id);
                                            ?>
                                        <li class="item-lesson">
                                            <div class="pull-left current-lesson inline-class">
                                                <i class="fa fa-angle-right icon-current-custom {!! ($mix_test_highest_step == $mix_test->order_lesson) ? '' : 'not-show' !!}" aria-hidden="true"></i>
                                            </div>
                                            <div class="icon-status-lesson inline-class">
                                                <div class="border-left-custom {!! ($key_mix_test == 0) ? 'first-border' : '' !!}">

                                                </div>
                                                @if($check_vip)
                                                    <div class="status-custom-area">
                                                        <div class="pro-lesson">
                                                            PRO
                                                        </div>
                                                    </div>
                                                @elseif($mix_test->order_lesson > $mix_test_highest_step)
                                                    <div class="status-custom-area item-lock">
                                                        <i class="fa fa-lock icon-status-custom icon-item-lock" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title-item-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="inline-class pro-title-lesson">
                                                        PRO
                                                    </div>
                                                    {!! $mix_test->title !!}
                                                @elseif($mix_test->order_lesson > $mix_test_highest_step)
                                                    {!! $mix_test->title !!}
                                                @else
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.mix_test') . '-mix_test/' . $mix_test->id . '-mix_test')}}">
                                                        {!! $mix_test->title !!}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="pull-right status-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-upgrade">
                                                            <a href="#">
                                                                Upgrade Now
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @elseif($mix_test->order_lesson > $mix_test_highest_step)
                                                    <div class="pull-right go-to-item locked-item">
                                                        Locked
                                                    </div>
                                                @else
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                            {!! $highest_score->highest_correct !!}/{!! $mix_test->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.mix_test') . '-mix_test/' . $mix_test->id . '-mix_test')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{--Show Full Test --}}
                        @elseif($type_lesson_id == config('constants.type_lesson.full_test'))
                            @if(sizeof($full_tests) > 0)
                                <li data-toggle="collapse" data-target="#full_test" class="collapsed item-primary" aria-expanded="true">
                                    <a href="#">
                                        <i class="fa fa-pencil icon-head-title-custom" aria-hidden="true"></i>
                                        <h6 class="title-item-primary">
                                            Full Tests
                                        </h6>
                                        <i class="fa fa-angle-up icon-angle-up-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                        <i class="fa fa-angle-down icon-angle-down-custom icon-up-down-custom pull-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <ul class="list-item-lesson collapse show" id="full_test">
                                    <?php
                                    $full_test_highest_step = $readingStatusLearningOfUserService->getHighestStepLessonService($current_level_lesson->id, 0, config('constants.type_lesson.full_test'));
                                    ?>
                                    @foreach($full_tests as $key_full_test => $full_test)
                                        <?php
                                        $check_vip = $readingLessonService->checkVipLesson(config('constants.type_lesson.mix_test'), $full_test->id);
                                        $highest_score = $readingResultService->getHighestScoreLesson(config('constants.type_lesson.mix_test'), $full_test->id);
                                        ?>
                                        <li class="item-lesson">
                                            <div class="pull-left current-lesson inline-class">
                                                <i class="fa fa-angle-right icon-current-custom {!! ($full_test_highest_step == $full_test->order_lesson) ? '' : 'not-show' !!}" aria-hidden="true"></i>
                                            </div>
                                            <div class="icon-status-lesson inline-class">
                                                <div class="border-left-custom {!! ($key_full_test == 0) ? 'first-border' : '' !!}">

                                                </div>
                                                @if($check_vip)
                                                    <div class="status-custom-area">
                                                        <div class="pro-lesson">
                                                            PRO
                                                        </div>
                                                    </div>
                                                @elseif($full_test->order_lesson > $full_test_highest_step)
                                                    <div class="status-custom-area item-lock">
                                                        <i class="fa fa-lock icon-status-custom icon-item-lock" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="status-custom-area">
                                                        <i class="fa fa-code icon-status-custom" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title-item-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="inline-class pro-title-lesson">
                                                        PRO
                                                    </div>
                                                    {!! $full_test->title !!}
                                                @elseif($full_test->order_lesson > $full_test_highest_step)
                                                    {!! $full_test->title !!}
                                                @else
                                                    <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.full_test') . '-full_test/' . $full_test->id . '-full_test')}}">
                                                        {!! $full_test->title !!}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="pull-right status-lesson inline-class">
                                                @if($check_vip)
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-upgrade">
                                                            <a href="#">
                                                                Upgrade Now
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @elseif($full_test->order_lesson > $full_test_highest_step)
                                                    <div class="pull-right go-to-item locked-item">
                                                        Locked
                                                    </div>
                                                @else
                                                    <div class="pull-right highest-score-lesson">
                                                        @if($highest_score == null)
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        @else
                                                            {!! $highest_score->highest_correct !!}/{!! $full_test->total_questions !!}
                                                        @endif
                                                    </div>
                                                    <div class="pull-right go-to-item">
                                                        <div class="inline-class title-go-to-item">
                                                            <a href="{{url('/reading/' . $level_lesson_id . '-level/readingLesson/' . config('constants.type_lesson.full_test') . '-full_test/' . $full_test->id . '-full_test')}}">
                                                                Let's Go
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
