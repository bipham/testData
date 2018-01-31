<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 10/23/2017
 * Time: 3:29 PM
 */
$readingTypeQuestionService = new App\Services\ReadingTypeQuestionService();
$readingLessonService = new App\Services\ReadingLessonService();
$readingMixTestService = new App\Services\ReadingMixTestService();
$readingFullTestService = new App\Services\ReadingFullTestService();
$readingLearningTypeQuestionService = new App\Services\ReadingLearningTypeQuestionService();
$readingLevelLessonService = new App\Services\ReadingLevelLessonService();
$readingStatusLearningOfUserService = new App\Services\ReadingStatusLearningOfUserService();
$readingResultService = new App\Services\ReadingResultService();
?>
@extends('layout.master')
@section('meta-title')
    Overview {!! $current_level_lesson->level !!}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/client/readingInfoOverview.css')}}">
@endsection

@section('content')
    <div class="container row overview-page page-custom">
        <div class="list-course-section">
            @include('utils.readingListCourseSection')
        </div>
        <div class="info-course-section">
            @include('utils.readingInfoCourseSection')
        </div>
    </div>
@endsection

@section('scripts')

@endsection
