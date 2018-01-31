<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 03/12/2017
 * Time: 12:38 PM
 */
?>
<div class="reading-view">
    <div class="content-story">
        <div class="content-viewport">
            <div class="cover-page" id="cover-story">
                <img class="img-cover" src="{{ asset('storage/img/english_stories/' . stripUnicode($story->title) . '/' . $story->image_cover) }}" alt="{!! $story->title !!}" />
            </div>
            @foreach($chapters as $chapter)
                <div id="chapter-{!! $chapter->order_chapter !!}" class="chapter-story" data-order-chapter="{!! $chapter->order_chapter !!}">
                    <div class="title-chapter-area">
                        <h3 class="order-chapter">
                            CHAPTER {!! $chapter->order_chapter !!}
                        </h3>
                        <h2 class="title-chapter">
                            {!! $chapter->title_chapter !!}
                        </h2>
                    </div>
                    <div class="content-chapter">
                        {!! $chapter->content_chapter !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
