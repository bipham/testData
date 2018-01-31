<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 04/12/2017
 * Time: 10:50 AM
 */
?>
@extends('layout.masterForEnglishStory')
@section('css')
    <link rel="stylesheet" href="{{asset('libs/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('libs/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/viewStoryDetail.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/storyEnglish.css')}}">
@endsection

@section('meta-title')
    English-story - UCENDU
@endsection

@section('titleTypeLesson')
    English Story
@endsection

@section('content')
    <div class="container story-english-page">
        <div class="slider-home-page slider-top-view-story-outer" data-image-number="1">
            <div class="slide-home-page-area container-story-custom">
                <div class="title-slider-area">
                    <h6 class="title-slider">
                        <span>Top viewed story</span>
                    </h6>
                </div>
                @include('components.englishStory.sliderTopViewStory')
            </div>
        </div>
        <div class="new-stories-area container-story-custom">
            <h6 class="title-slider text-center">
                New Stories
            </h6>
            @include('components.englishStory.sliderNewestStories')
        </div>
        <div class="author-of-week-section">
            <div class="container-story-custom">
                <div class="title-slider-area">
                    <h6 class="title-slider">
                        <span>Author of Weeks</span>
                    </h6>
                </div>
                @include('components.englishStory.sliderAuthorOfWeek')
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <div class="footer-english-page">
        <div class="container">
            <div class="pull-left"> Copyright © UCENDU 2017. All right reserved. </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/client/viewStoryDetail.js')}}"></script>
    <script src="{{asset('libs/slick/slick.min.js')}}"></script>
    <script src="{{asset('js/client/englishStory.js')}}"></script>
@endsection
