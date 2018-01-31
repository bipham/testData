<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 04/12/2017
 * Time: 2:57 PM
 */
?>
<div class="slider-story slider-custom slider-newest-stories">
    @foreach($new_stories as $index_new_story => $new_story)
        <div class="item-slider item-new-story">
            <div class="top-info-item-slide">
                <div class="img-auto-scale-outer img-new-story item-shadow-cutom">
                    <a class="img-auto-scale-middle" href="{{url('englishStory/viewStoryDetail/' . $new_story->id)}}">
                        <img src="{{url('storage/img/english_stories/story-' . $new_story->id . '/' . $new_story->image_cover)}}" class="img-auto-scale img-responsive img-top-slider img-new-story-slide" alt="{!! $new_story->title !!}">
                    </a>
                    <div class="frame-hover-info-slide">
                        <div class="more-info-new-story">
                            <h6 class="more-info-slide">
                                <strong>Level:</strong> {!! $new_story->levelStory->level !!}
                            </h6>
                            <h6 class="more-info-slide">
                                <strong>Genre:</strong> {!! $new_story->genreStory->genre !!}
                            </h6>
                            <h6 class="more-info-slide">
                                <strong>Length:</strong> {!! $new_story->lengthStory->length !!}
                            </h6>
                        </div>
                        {{--<div class="button-direct">--}}
                            {{--<a href="{{url('englishStory/viewStoryDetail/' . $new_story->id)}}" class="icon-link-to-story btn link-story">--}}
                                {{--<i class="inline-class fa fa-eye" aria-hidden="true"></i>--}}
                                {{--<span class="inline-class enter-read-story">Read</span>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="bottom-info-item-slide">
                <div class="title-item-new-story-slide">
                    <h6 class="title-item-new-story">
                        <a href="{{url('englishStory/viewStoryDetail/' . $new_story->id)}}" class="link-story">
                            {!! $new_story->title !!}
                        </a>
                    </h6>
                    <div class="author-item-slide author-new-story-slide">
                        by <a href="#">{!! $new_story->authorStory->name !!}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
