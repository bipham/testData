<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 10/27/2017
 * Time: 2:03 AM
 */
?>
@extends('layout.masterNoFooterClient')
@section('meta-title')

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/client/readingSolution.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/libs/DataTables/datatables.min.css')}}"/>
@endsection

@section('titleTypeLesson')
    {!! $lesson->title !!}
@endsection

@section('typeLessonHeader')
    @if ($type_lesson_id < 3)
        @if($lesson->type_question_id > 0)
            {!! $lesson->typeQuestion->name !!}
        @endif
    @else

    @endif
@endsection

@section('content')
    @include('utils.readingViewSolutionTable')
    <div class="container solution-detail-page page-custom hidden" data-type-lesson-id="{!! $type_lesson_id !!}" >
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        @if($type_lesson_id == 0)
            @if($lesson->view_layout == 1)
                <div class="solution-detail panel-container transform-custom" id="solution-area" data-lessonid="{!! $lesson->id !!}">
                    <div class="left-panel-custom one-layout-result" id="lesson-highlight-area" data-lessonid="{!! $lesson->id !!}">
                        {!! $lesson->content_answer_quiz !!}
                    </div>
                </div>
            @else
                <div class="solution-detail panel-container transform-custom">
                    <div class="left-panel-custom panel-left panel-top" id="lesson-highlight-area" data-lessonid="{!! $lesson->id !!}">
                        {!! $lesson->content_highlight !!}
                    </div>
                    <div class="splitter-custom splitter">
                    </div>
                    <div class="splitter-horizontal-custom splitter-horizontal">
                    </div>
                    <div class="right-panel-custom panel-right panel-bottom active-quiz" id="solution-area" data-quizId="{!! $lesson->id !!}">
                        {!! $lesson->content_answer_quiz !!}
                    </div>
                </div>
            @endif
        @else
            <div class="solution-detail panel-container transform-custom">
                <div class="left-panel-custom panel-left panel-top" id="lesson-highlight-area" data-lessonid="{!! $lesson->id !!}">
                    {!! $lesson->content_highlight !!}
                </div>
                <div class="splitter-custom splitter">
                </div>
                <div class="splitter-horizontal-custom splitter-horizontal">
                </div>
                <div class="right-panel-custom panel-right panel-bottom active-quiz" id="solution-area" data-quizId="{!! $lesson->id !!}">
                    {!! $lesson->content_answer_quiz !!}
                </div>
            </div>
        @endif
        @include('utils.readingExplanation')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/client/readingCommentFunctions.js')}}"></script>
    <script src="{{asset('js/client/readingSolutionDetail.js')}}"></script>
    <script src="{{asset('js/client/readingFunctionLesson.js')}}"></script>
    <script type="text/javascript" src="{{asset('/libs/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/admin/readingTables.js')}}"></script>
    <script src="{{asset('libs/chart/Chart.min.js')}}"></script>
    <script type="text/javascript">
        $('.result-overview').hide();

        $('.question-quiz').each(function () {
            var qnumber = $(this).data('qnumber');
            var qorder = $(this).attr('name');
            var solution_key = $('.explain-area-' + qnumber + ' .key-answer').html();
            qorder = qorder.match(/\d+/);
            $('.view-solution-question-' + qorder).html(solution_key);
        });
    </script>
@endsection