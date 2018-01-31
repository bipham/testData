<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 10/11/2017
 * Time: 3:36 PM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Reading - Create New Learning Type Question
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/readingUploadNewLesson.css')}}">
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <div class="container new-learning-container upload-page-custom" data-idquestion="{!! $last_question_custom_id !!}">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <form role="form" action="{!!url('createNewLearningTypeQuestion')!!}" method="POST">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <h1 class="title-new-type-action">Create New Learning Type Question</h1>
            <div class="row step-first">
                <div class="form-group">
                    <label for="list_level">
                        Chon level lesson!
                    </label>
                    <select class="form-control" id="list_level" name="list_level" >
                        @foreach($all_levels as $all_level)
                            <option value="{!! $all_level->id !!}">{!! $all_level->level !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="list_type_questions">
                        Chon dạng câu hỏi!
                    </label>
                    <select class="form-control" id="list_type_questions" name="list_type_questions">
                        <option value="-{!! $all_levels[0]->id !!}">All Of Types</option>
                        @foreach($all_type_questions as $type_question)
                            <option value="{!! $type_question->id !!}">{!! $type_question->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title_section">
                        Title section
                    </label>
                    <input type="text" class="form-control" placeholder="Title section" id="title_section" name="title_section" required>
                </div>
                <div class="form-group">
                    <label for="name_icon_section">
                        Icon section
                    </label>
                    <input type="text" class="form-control" placeholder="fa-cog" id="name_icon_section" name="name_icon_section" required>
                </div>
                <button type="button" class="btn btn-primary btn-next-step-second">
                    Next
                </button>
            </div>
            <div class="row step-second hidden">
                <div class="form-group">
                    <label for="view_layout">
                        View layout
                    </label>
                    <input type="number" class="form-control" min="1" max="2" value="1" placeholder="View layout" id="view_layout" name="view_layout" required>
                </div>
                <div class="form-group first-layout-content">
                    <label for="content_section">
                        Nội dung
                    </label>
                    <textarea id="content_section" rows="10" cols="80" name="content_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'content_section' );
                    </script>
                </div>
                <div class="form-group left-content-group hidden two-layout-content">
                    <label for="left_section">
                        Left content
                    </label>
                    <textarea id="left_section" rows="10" cols="80" name="left_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'left_section' );
                    </script>
                </div>
                <div class="form-group right-content-group hidden two-layout-content">
                    <label for="right_section">
                        Right content
                    </label>
                    <textarea id="right_section" rows="10" cols="80" name="right_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'right_section' );
                    </script>
                </div>
                <div class="btn-area-custom">
                    <button type="button" class="btn btn-primary btn-prev-step-first">
                        Prev
                    </button>
                    <button type="button" class="btn btn-primary btn-next-step-third">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-third hidden">
                <div class="form-group">
                    <label for="list_level_users">
                        Chon Level User
                    </label>
                    <select class="form-control" id="list_level_users" name="list_level_users" >
                        @foreach($all_level_users as $level_user)
                            @if($level_user->id > 1)
                                <option value="{!! $level_user->id !!}">{!! $level_user->level !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="order_lesson">
                        Step section
                    </label>
                    <input type="number" class="form-control" min="1" value="" placeholder="Step 0" id="order_lesson" name="order_lesson" required>
                </div>
                <div class="page-upload row first-layout-content">
                    <div class="panel-one-layout preview-content-quiz preview-content-quiz col-md-8">
                        <div class="card-header">
                            <h3 class="text-left">
                                Nội dung:
                            </h3>
                        </div>
                        <div class="card-block">
                            <div id="sandbox-quiz" class="quiz-learning-1">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 answer-key-area">
                        <div class="card-header">
                            <h3 class="text-left">
                                Đáp án:
                            </h3>
                        </div>
                        <div class="card-block">
                            <h6 class="no-question">No Question!</h6>
                            <div class="answer-area answer-area-1">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-upload row two-layout-content hidden">
                    <div class="inner-page-upload panel-container col-md-8">
                        <div class="upload-left-panel-custom panel-left upload-panel-top card highlight-sandbox col-md-8 preview-left-content">
                            <div class="card-header">
                                <h3 class="text-left">
                                    Highlight đáp án!
                                </h3>
                            </div>
                            <div class="card-block">
                                <div id="sandbox">
                                </div>
                            </div>
                        </div>
                        <div class="splitter-custom splitter">
                        </div>
                        <div class="splitter-horizontal-custom splitter-horizontal">
                        </div>
                        <div class="upload-right-panel-custom panel-right upload-panel-bottom active-quiz card preview-content-quiz">
                            <div class="card-header">
                                <h3 class="text-left">
                                    Nội dung câu hỏi:
                                </h3>
                            </div>
                            <div class="card-block">
                                <div id="quiz-learning" class="quiz-learning-2">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 answer-key-area">
                        <div class="card-header">
                            <h3 class="text-left">
                                Đáp án:
                            </h3>
                        </div>
                        <div class="card-block">
                            <h6 class="no-question">No Question!</h6>
                            <div class="answer-area answer-area-2">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-area-custom">
                    <button type="button" class="btn btn-primary btn-prev-step-second">
                        Prev
                    </button>
                    <button type="button" class="btn btn-warning btn-next-step-fourth">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-preview-post hidden">
                <div class="page-upload row first-layout-content">
                    <div class="card preview-post">
                        <div class="card-header">
                            <h3 class="text-left">
                                Noi dung Post!
                            </h3>
                        </div>
                        <div class="card-block">
                            <div id="pr-quiz-full"></div>
                        </div>
                    </div>
                </div>
                <div class="page-upload row two-layout-content hidden">
                    <div class="col-md-6 card preview-post">
                        <div class="card-header">
                            <h3 class="text-left">
                                Noi dung Post!
                            </h3>
                        </div>
                        <div class="card-block">
                            <div id="pr-post"></div>
                        </div>
                    </div>
                    <div class="col-md-6 card preview-quiz">
                        <div class="card-header">
                            <h3 class="text-left">
                                Noi dung Quiz!
                            </h3>
                        </div>
                        <div class="card-block">
                            <div id="pr-quiz">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-prev-step-third btn-custom-step">
                        Prev
                    </button>
                    <button type="button" class="btn btn-warning btn-create-new-section-type-question">
                        Create section
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/admin/adminCreateNewItemFunctions.js')}}"></script>
    <script src="{{asset('js/admin/adminGetDataFunctions.js')}}"></script>
    <script src="{{asset('js/admin/readingHighlightLearning.js')}}"></script>
    <script src="{{asset('js/admin/readingNewLearningTypeQuestion.js')}}"></script>
@endsection

