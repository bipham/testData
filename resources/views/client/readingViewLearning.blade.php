@extends('layout.masterNoFooterClient')
@section('meta-title')
    {!! $lesson->title !!}
@endsection
@section('css')

@endsection

@section('titleTypeLesson')
    {!! $lesson->title !!}
@endsection

@section('typeLessonHeader')
    Introduction {!! ($lesson->type_question_id < 0) ? '' : '- ' . $lesson->typeQuestion->name !!}
@endsection

@section('content')
    <div class="container lesson-detail-page page-custom" data-level-lesson-id="{!! $level_lesson_id !!}" data-type-lesson-id="{!! $type_lesson_id !!}" data-type-question-id="{!! $type_question_id_current !!}">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        {{--<div class="overlay-lesson">--}}
            {{--<div class="row-fluid header-product outer-banner-custom">--}}
                {{--<div class="breadcrumb-header middle-banner-custom">--}}
                    {{--<div class="content-breadcrumb-header content-banner-custom">--}}
                        {{--<div class="info-overview">--}}
                            {{--<h4 class="reading-title-start">--}}
                                {{--Are you ready?--}}
                            {{--</h4>--}}
                            {{--<button type="button" class="btn btn-outline-danger btn-reading-start-test">START</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="lesson-detail panel-container">
            @if ($lesson->view_layout == 2)
                <div class="left-panel-custom panel-left panel-top" id="lesson-content-area" data-lesson-id="{!! $lesson->id !!}">
                    {!! $lesson->left_content !!}
                </div>
                <div class="splitter-custom splitter">
                </div>
                <div class="splitter-horizontal-custom splitter-horizontal">
                </div>
                <div class="right-panel-custom panel-right panel-bottom active-quiz" id="quiz-test-area" data-quizId="{!! $lesson->id !!}">
                    {!! $lesson->right_content !!}
                </div>
            @else
                <div class="learning-detail" id="lesson-content-area" data-lesson-id="{!! $lesson->id !!}">
                    <div class="active-quiz" id="quiz-test-area" data-quizId="{!! $lesson->id !!}">
                        {!! $lesson->content_section !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/client/lessonDetail.js')}}"></script>
    <script src="{{asset('/libs/countdown/jquery.countdown.js')}}"></script>
@endsection