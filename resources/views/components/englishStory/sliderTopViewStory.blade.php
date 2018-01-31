<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 04/12/2017
 * Time: 11:05 AM
 */
?>
<div class="slider-story slider-custom slider-top-view-story">
    @foreach($top_viewed_stories as $index_top_viewed_story => $top_viewed_story)
        <div class="item-slider item-top-view-story">
            <div class="left-info-item-slider pull-left">
                <h6 class="title-item-slide">
                    <a href="{{url('englishStory/viewStoryDetail/' . $top_viewed_story->id)}}" class="link-story">
                        {!! $top_viewed_story->title !!}
                    </a>
                </h6>
                <div class="author-item-slide">
                    by <a href="#">{!! $top_viewed_story->authorStory->name !!}</a>
                </div>
            </div>
            <div class="center-info-item-slider pull-left text-center">
                <div class="item-shadow-cutom img-auto-scale-outer img-slider-outer img-top-view-story">
                    <a class="img-auto-scale-middle link-image-story img-border-cover" href="{{url('englishStory/viewStoryDetail/' . $top_viewed_story->id)}}">
                        <img src="{{url('storage/img/english_stories/story-' . $top_viewed_story->id . '/' . $top_viewed_story->image_cover)}}" class="img-auto-scale img-responsive img-top-slider img-top-viewed-story-slider" alt="{!! $top_viewed_story->title !!}">
                    </a>
                </div>
            </div>
            <div class="right-info-item-slider pull-right">
                <div class="short-description-slider">
                    {!! $top_viewed_story->description !!}
                </div>
                @if($top_viewed_story->description != null || $top_viewed_story->description != '')
                <hr class="hr-intro-item">
                @endif
                <div class="more-info-item-slide">
                    <h6 class="more-info-slide">
                        <strong>Level:</strong> {!! $top_viewed_story->levelStory->level !!}
                    </h6>
                    <h6 class="more-info-slide">
                        <strong>Genre:</strong> {!! $top_viewed_story->genreStory->genre !!}
                    </h6>
                    <h6 class="more-info-slide">
                        <strong>Length:</strong> {!! $top_viewed_story->lengthStory->length !!}
                    </h6>
                </div>
            </div>
        </div>
    @endforeach
</div>
