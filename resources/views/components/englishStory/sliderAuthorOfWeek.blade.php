<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 04/12/2017
 * Time: 4:52 PM
 */
?>
<div class="slider-story slider-custom slider-author-of-week">
    @foreach($author_of_weeks as $index_author_of_week => $author_of_week)
        <div class="item-slider item-author-story-of-week">
            <div class="left-info-item-slider pull-left">
                <h6 class="title-item-slide">
                    <a href="#" class="link-story">
                        {!! $author_of_week->name !!}
                    </a>
                </h6>
                <div class="introduction-author-item-slide">
                    {!! $author_of_week->introduction !!}
                </div>
                <div class="show-all-genre-of-author">
                    <?php
                    $storyEnglishService = new App\Services\StoryEnglishService();
                    $author_genres = $storyEnglishService->getAllGenresOfAuthor($author_of_week->id);
                    ?>
                    <span class="title-genre-author inline-class">
                        Genre:
                    </span>
                    <span class="inline-class detail-genre-author">
                        @for($i=0; $i < sizeof($author_genres); $i++)
                            <?php
                            $genre_author = $storyEnglishService->getNameOfGenres($author_genres[$i]->genre_id);
                            ?>
                        {!! $genre_author->genre !!}
                            @if($i < (sizeof($author_genres) - 1))
                                ,
                            @endif
                        @endfor
                    </span>
                </div>
            </div>
            <div class="center-info-item-slider pull-left text-center">
                <div class="img-auto-scale-outer img-slider-outer img-author-story-of-week-outer">
                    <a class="img-auto-scale-middle link-image-story" href="#">
                        <img src="{{url('storage/img/author_story/' . $author_of_week->avatar)}}" class="img-auto-scale img-responsive img-top-slider img-author-story-of-week" alt="{!! $author_of_week->name !!}">
                    </a>
                </div>
            </div>
            <div class="right-info-item-slider right-section-author-of-week pull-right">
                <div class="row list-story-of-author">
                    <?php
                    $stories_of_author = $author_of_week->englishStories()->select('id', 'title', 'image_cover')->orderBy('viewed', 'desc')->take(4)->get()->all();
                    ?>
                    @foreach($stories_of_author as $story_of_author)
                        <div class="story-item-author">
                            <div class="top-info-item-slide">
                                <div class="img-auto-scale-outer img-story-of-author-outer item-shadow-cutom">
                                    <a class="img-auto-scale-middle" href="{{url('englishStory/viewStoryDetail/' . $story_of_author->id)}}">
                                        <img src="{{url('storage/img/english_stories/story-' . $story_of_author->id . '/' . $story_of_author->image_cover)}}" class="img-auto-scale img-responsive img-top-slider img-story-of-author" alt="{!! $story_of_author->title !!}">
                                    </a>
                                </div>
                            </div>
                            <div class="bottom-info-item-slide">
                                <div class="title-item-story-of-author">
                                    <h6 class="title-story-of-author">
                                        <a href="{{url('englishStory/viewStoryDetail/' . $story_of_author->id)}}" class="link-story">
                                            {!! $story_of_author->title !!}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

