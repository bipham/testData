<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/7/2017
 * Time: 3:30 PM englishStoryViewDetail.blade
 */
?>
@extends('layout.masterForEnglishStory')
@section('meta-title')
    English-story - UCENDU
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('libs/media-element-player/src/mediaelementplayer.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/media-element-player/src/mep-feature-playlist.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/viewStoryDetail.css')}}">
    <?php
    $bg = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg');
    $i = rand(0, count($bg)-1); // generate random number size of the array
    $i2 = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
    $selectedBg2 = "$bg[$i2]"; // set variable equal to which random filename was chosen
    ?>
    <style type="text/css">
        .outer-banner-custom {
            background: url(/imgs/background-header/{!! $selectedBg2 !!});
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-bottom: 80px;
            height: 400px;
        }

        .header-product {
            background: url(/imgs/background-header/{!! $selectedBg !!});
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script src="{{asset('libs/within-viewport/withinviewport.js')}}"></script>
@endsection
@section('titleTypeLesson')
    {!! $story->title !!}
@endsection

@section('typeLessonHeader')
    {!! $story->authorStory->name !!}
@endsection
@section('content')
    <div class="row-fluid outer-banner-custom">
        <div class="breadcrumb-header middle-banner-custom">
            <div class="content-breadcrumb-header content-banner-custom">
                <div class="title-story-overview">
                    <i class="icon-story-custom fa fa-book" aria-hidden="true"></i>
                    <h2 class="title-post">{!! $story->title !!}</h2>
                </div>
                <div class="info-story">
                    <div class="info-level basic-story-info">
                        <span class="title-info-basic">
                            Level:
                        </span>
                        <span class="level-story info-detail-story">
                            {!! $story->levelStory->level !!}
                        </span>
                    </div>
                    <div class="info-genre basic-story-info">
                        <span class="title-info-basic">
                            Genre:
                        </span>
                        <span class="genre-story info-detail-story">
                            {!! $story->genreStory->genre !!}
                        </span>
                    </div>
                    <div class="info-length basic-story-info">
                        <span class="title-info-basic">
                            Length:
                        </span>
                        <span class="length-story info-detail-story">
                            {!! $story->lengthStory->length !!}
                        </span>
                    </div>
                </div>
                <div class="author-info basic-story-info">
                        <span class="author-avatar">
                            <img class="img-author" src="{{ asset('storage/img/author_story/' . $story->authorStory->avatar) }}" alt="{!! $story->authorStory->name !!}" />
                        </span>
                    <span class="author-name">
                            {!! $story->authorStory->name !!}
                        </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container page-story-custom">
        <div class="row">
            <div class="col-md-3 list-chapters">
                @include('components.englishStory.viewListChapters')
            </div>
            <div class="col-md-6 reading-view-story">
                @include('components.englishStory.viewContentStory')
            </div>
            <div class="col-md-3 list-download-story">
                @include('components.englishStory.viewListDownload')
            </div>
        </div>
    </div><!-- /container -->
    <div class="row-fluid player-area">
        @include('components.englishStory.viewAudioPlayer')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('libs/media-element-player/src/mediaelement-and-player.min.js')}}"></script>
    <script src="{{asset('libs/media-element-player/src/mep-feature-playlist.js')}}"></script>
    <script src="{{asset('js/client/viewStoryDetail.js')}}"></script>
    <script>
        var features = ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'playlist', 'current', 'progress', 'duration', 'volume'];
        $('audio').mediaelementplayer({
            loop: true,
            shuffle: true,
            playlist: true,
            audioHeight: 30,
            autoPlay: false,
            playlistposition: 'top',
            features: features,
//                showPlaylist: false,
            autoClosePlaylist: true,
            currentMessage: 'Now playing:'
        });
    </script>
@endsection
